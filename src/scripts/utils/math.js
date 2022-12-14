const diameter = (w, h, x, y) => {
	const width = Math.max(w - x, x) * 2;
	const height = Math.max(h - y, y) * 2;

	return Math.sqrt(width * width + height * height);
};

export default diameter
