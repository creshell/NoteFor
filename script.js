function toggleOverlay() {
    const container = document.getElementById('main');
    const overlayRight = document.querySelector('.overlay-right');
    const overlayLeft = document.querySelector('.overlay-left');
    
    container.classList.toggle('right-panel-active');

    overlayRight.style.transform = container.classList.contains('right-panel-active') ? 'translate(100%)' : 'translate(0)';
    overlayLeft.style.transform = container.classList.contains('right-panel-active') ? 'translate(100%)' : 'translate(0)';
}


