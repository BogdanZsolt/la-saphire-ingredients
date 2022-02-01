document.addEventListener("DOMContentLoaded", () => {
  if(document.querySelector('#ingredients-section')){
    const menuItems = document.querySelectorAll('a[data-filter]')
    const items = document.querySelectorAll('.item-wrapper')
    let letter = '';
    let filter = '';
    console.log(menuItems)
    items.forEach(item => {
      letter = item.innerText[0].toLowerCase()
      item.classList.add("cat-" + letter);
      menuItems.forEach(menuItem => {
        if(menuItem.innerText === letter.toUpperCase()){
          menuItem.classList.remove('disabled');
        }
      })
    })
    menuItems.forEach(menuItem => {
      if(menuItem.classList.value !== 'disabled') {
        menuItem.addEventListener('click', ()=>{
          menuItems.forEach(amItem =>{
            if(amItem.classList.contains('active')){
              amItem.classList.remove('active')
            }
          })
          menuItem.classList.add('active');
          filter = menuItem.dataset.filter
          console.log(filter)
          items.forEach(item => {
            if(filter === '*'){
              item.style.display = 'flex';
            } else {
              if(item.classList.contains(filter)){
                item.style.display = 'flex'
              } else {
                item.style.display = 'none'
              }
            }
          })
        })
      }
    })
  }
});
