document.addEventListener('DOMContentLoaded', () => {
  const main = document.querySelector('#main');
  const loader = document.querySelector('#loader');
  console.log('fslkdfjsklfj');
  if (loader && main) {
    loader.classList.add('d-none');
    main.classList.remove('d-none');
  }
});
