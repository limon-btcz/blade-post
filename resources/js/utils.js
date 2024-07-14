// basic toastify
export function showToast(duration) {
  const toast = document.getElementById('toast');
  if(toast) {
    toast.classList.remove('-translate-y-[200px]');

    setTimeout(() => {
      toast.classList.add('-translate-y-[200px]');
    }, duration);
  }
}

// to hide the toast manually
export function hideToast() {
  const toast = document.getElementById('toast');
}

// only for index and posts pages
export function stickyNav() {
  const navbar = document.getElementById('navbar');
  if(window.scrollY >= 200) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
}

// this function need to check. mainContainer height not set properly
export function addPaddingToMainContainer() {
  // get the elements
  const navbar = document.getElementById('navbar');
  const mainContainer = document.getElementById('mainContainer');
  
  // get the value of navbar height
  const navbarHeight = navbar.offsetHeight;
    
  // set the height of main container
  mainContainer.style.paddingTop = `${navbarHeight}px`;
}