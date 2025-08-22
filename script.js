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
    const housePlanForm = document.getElementById('housePlanForm');

    // Combine forms for submission
    if (housePlanForm) {
        housePlanForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Validate required fields
            const name = document.getElementById('name').value.trim();
            const mobile = document.getElementById('mobile').value.trim();
            const email = document.getElementById('email').value.trim();
            const city = document.getElementById('city').value.trim();
            
            if (!name || !mobile || !email || !city) {
                showErrorMessage('Please fill in all required fields: Name, Mobile, Email, and City.');
                return;
            }
            
            const housePlanData = new FormData(housePlanForm);
            
            try {
                const response = await fetch('submit.php', {
                    method: 'POST',
                    body: housePlanData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showSuccessMessage(result.message);
                    housePlanForm.reset();
                    // Show pay now button
                    document.getElementById('payNowBtn').style.display = 'inline-block';
                } else {
                    showErrorMessage(result.message);
                }
            } catch (error) {
                showErrorMessage('An error occurred while submitting your request. Please try again.');
            }
        });
    }

    // Payment modal functionality
    const payNowBtn = document.getElementById('payNowBtn');
    const paymentModal = document.getElementById('paymentModal');
    const upiBtn = document.querySelector('.upi-btn');
    
    if (payNowBtn) {
        payNowBtn.addEventListener('click', () => {
            paymentModal.style.display = 'block';
        });
    }
    
    if (upiBtn) {
        upiBtn.addEventListener('click', (e) => {
            e.preventDefault();
            paymentModal.style.display = 'block';
        });
    }
    
    // Close payment modal
    const paymentClose = paymentModal?.querySelector('.close');
    if (paymentClose) {
        paymentClose.onclick = function() {
            paymentModal.style.display = 'none';
        }
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == paymentModal) {
            paymentModal.style.display = 'none';
        }
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

// Admin functions for status updates
function updateStatus(id, status) {
    if (confirm(`Are you sure you want to ${status} this submission?`)) {
        fetch('update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error updating status: ' + error.message);
        });
    }
}