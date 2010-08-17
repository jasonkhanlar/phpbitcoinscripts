#!/usr/bin/env python
#Courtesy of ArtForz - http://www.bitcoin.org/smf/index.php?topic=402.msg3395#msg3395
import struct
import hashlib

def uint256_deser(s):
	r = 0L
	for i in xrange(8):
		t = struct.unpack("<I", s[i*4:i*4+4])[0]
		r += t << (i * 32)
	return r

def uint256_ser(u):
	rs = ""
	for i in xrange(8):
		rs += struct.pack("<I", u & 0xFFFFFFFFL)
		u >>= 32
	return rs

def uint256_from_compact(c):
	nbytes = (c >> 24) & 0xFF
	v = (c & 0xFFFFFFL) << (8 * (nbytes - 3))
	return v

def get_difficulty(c):
	return float(uint256_from_compact(0x1D00FFFF) * 1000 // uint256_from_compact(c)) / 1000.

class CBlock:
	def deserialize(self, s):
		self.nVersion = struct.unpack("<i", s[0:4])[0]
		self.hashPrevBlock = uint256_deser(s[4:36])
		self.hashMerkleRoot = uint256_deser(s[36:68])
		self.nTime = struct.unpack("<I", s[68:72])[0]
		self.nBits = struct.unpack("<I", s[72:76])[0]
		self.nNonce = struct.unpack("<I", s[76:80])[0]
		h1 = hashlib.sha256(s[0:80]).digest()
		self.hash = uint256_deser(hashlib.sha256(h1).digest())
		if self.hash > uint256_from_compact(self.nBits):
			raise ValueError("bad hash in %s" % repr(self))
		self.next = []
		self.blocknum = -1
	def __repr__(self):
		return "CBlock{ver=%08x hp=%064x hm=%064x nt=%08x nb=%08x nn=%08x h=%064x, n=%i}" % (self.nVersion, self.hashPrevBlock, self.hashMerkleRoot, self.nTime, self.nBits, self.nNonce, self.hash, self.blocknum)

def get_chain_len(blk):
	r = 1
	while len(blk.next) == 1:
		blk = blk.next[0]
		r += 1
	if len(blk.next) > 1:
		bestchainlen = 0
		for nextblk in blk.next:
			chainlen = get_chain_len(nextblk)
			if chainlen > bestchainlen:
				bestchainlen = chainlen
		r += bestchainlen
	return r


def readblocks(filename):
	f = open(filename, "rb")
	blocks = []
	idxmap = {}
	while True:
		try:
			magic = f.read(4)
			if magic != "\xf9\xbe\xb4\xd9":
				break
			blklen = struct.unpack("<i", f.read(4))[0]
			if blklen < 80:
				break
			blkdata = f.read(blklen)
			if len(blkdata) != blklen:
				break
		except:
			break
		blk = CBlock()
		blk.deserialize(blkdata)
		blocks.append(blk)
		idxmap[blk.hash] = blk
		if blk.hashPrevBlock:
			prevblk = idxmap[blk.hashPrevBlock]
			blk.prev = prevblk
			prevblk.next.append(blk)
	f.close()
	rootblk = blocks[0]
	del blocks
	del idxmap
	blk = rootblk
	curblkidx = 0
	while True:
		blk.blocknum = curblkidx
		if len(blk.next) == 0:
			blk.next = None
			break
		if len(blk.next) > 1:
			bestnextblk = None
			bestchainlen = 0
			for nextblk in blk.next:
				chainlen = get_chain_len(nextblk)
				if chainlen > bestchainlen:
					bestchainlen = chainlen
					bestnextblk = nextblk
				elif chainlen == bestchainlen:
					if nextblk.nTime < bestnextblk.nTime:
						bestchainlen = chainlen
						bestnextblk = nextblk
			blk.next = [bestnextblk]
		blk.next = blk.next[0]
		curblkidx += 1
		blk = blk.next
	
	blk = rootblk
	while blk:
		#print "%i %i %.3f 0x%08X" % (blk.blocknum, blk.nTime, get_difficulty(blk.nBits), blk.nBits)
		avghashes = 2**256 / uint256_from_compact(blk.nBits)
		print "%i %i %i %i" % (blk.blocknum, blk.nTime, avghashes, blk.nBits)
		blk = blk.next

if __name__ == "__main__":
	print readblocks("/home/necro/.bitcoin/blk0001.dat")
