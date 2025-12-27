// Простой JavaScript для менеджера задач

document.addEventListener('DOMContentLoaded', function() {
    // Автоматическое скрытие уведомлений через 5 секунд
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    });

    // Простая валидация формы
    const form = document.querySelector('.form');
    if (form) {
        const titleInput = form.querySelector('#title');
        
        if (titleInput) {
            form.addEventListener('submit', function(e) {
                const value = titleInput.value.trim();
                
                if (value.length < 3) {
                    e.preventDefault();
                    titleInput.classList.add('form__input--error');
                    titleInput.focus();
                    alert('Название задачи должно содержать минимум 3 символа');
                    return false;
                }
                
                if (value.length > 255) {
                    e.preventDefault();
                    titleInput.classList.add('form__input--error');
                    titleInput.focus();
                    alert('Название задачи не должно превышать 255 символов');
                    return false;
                }
            });
        }
    }
});
