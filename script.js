// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe animated elements
    document.querySelectorAll('.animated-text, .animated-paragraph, .animated-image, .feature, .step, .benefit').forEach(el => {
        observer.observe(el);
    });

    // Accordion functionality
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    accordionHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const accordionItem = header.parentElement;
            const content = accordionItem.querySelector('.accordion-content');
            const icon = header.querySelector('i:last-child');
            
            // Toggle active state
            accordionItem.classList.toggle('active');
            
            // Animate content
            if (accordionItem.classList.contains('active')) {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Form submission handling
    const contactForm = document.getElementById('contactForm');
    const housePlanForm = document.getElementById('housePlanForm');

    // Combine forms for submission
    if (housePlanForm) {
        housePlanForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Get contact form data
            const contactData = new FormData(contactForm);
            const housePlanData = new FormData(housePlanForm);
            
            // Combine both forms
            const combinedData = new FormData();
            
            // Add contact form data
            for (let [key, value] of contactData.entries()) {
                combinedData.append(key, value);
            }
            
            // Add house plan form data
            for (let [key, value] of housePlanData.entries()) {
                combinedData.append(key, value);
            }
            
            try {
                const response = await fetch('submit.php', {
                    method: 'POST',
                    body: combinedData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showSuccessMessage(result.message);
                    contactForm.reset();
                    housePlanForm.reset();
                } else {
                    showErrorMessage(result.message);
                }
            } catch (error) {
                showErrorMessage('An error occurred while submitting your request. Please try again.');
            }
        });
    }

    // WhatsApp button animation
    const whatsappBtn = document.querySelector('.whatsapp-btn');
    if (whatsappBtn) {
        setInterval(() => {
            whatsappBtn.classList.add('pulse');
            setTimeout(() => {
                whatsappBtn.classList.remove('pulse');
            }, 1000);
        }, 3000);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Success message function
function showSuccessMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'success-popup';
    messageDiv.innerHTML = `
        <div class="popup-content">
            <i class="fas fa-check-circle"></i>
            <h3>Success!</h3>
            <p>${message}</p>
            <button onclick="this.parentElement.parentElement.remove()">Close</button>
        </div>
    `;
    document.body.appendChild(messageDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 5000);
}

// Error message function
function showErrorMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'error-popup';
    messageDiv.innerHTML = `
        <div class="popup-content">
            <i class="fas fa-exclamation-circle"></i>
            <h3>Error</h3>
            <p>${message}</p>
            <button onclick="this.parentElement.parentElement.remove()">Close</button>
        </div>
    `;
    document.body.appendChild(messageDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 5000);
}