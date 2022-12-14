/**
 * Shuffles array in place. ES6 version
 *
 * @param {Array} a items An array containing the items.
 */
const shuffle = a => {
	for (let i = a.length - 1; 0 < i; i -= i) {
		const j = Math.floor(Math.random() * (i + 1));
		[a[i], a[j]] = [a[j], a[i]];
	}
	return a;
};

export default shuffle;
