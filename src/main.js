import './style.scss'

document.addEventListener('DOMContentLoaded', () => {
  initMobileNav()
})

const initMobileNav = () => {
  const mobileNavToggle = document.querySelector('button.toggle-mobile-nav')
  if (!mobileNavToggle) return

  mobileNavToggle.addEventListener('click', () => {
    const mainMenu = document.querySelector('.main-menu')
    if (!mainMenu) return
    mainMenu.classList.toggle('open')
  })
}
