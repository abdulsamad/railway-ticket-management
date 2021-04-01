document.addEventListener('DOMContentLoaded', () => {
	const main = document.querySelector('#main');
	const loader = document.querySelector('#loader');

	if (loader && main) {
		loader.classList.add('d-none');
		main.classList.remove('d-none');
	}
});
