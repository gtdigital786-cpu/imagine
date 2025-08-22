// Admin panel JavaScript functionality

document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const modal = document.getElementById('detailModal');
    const closeBtn = document.querySelector('.close');
    
    // Close modal when clicking the close button
    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }
    }
    
    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

// Function to view submission details
function viewDetails(id) {
    // Show loading state
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('modalContent');
    
    modalContent.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>';
    modal.style.display = 'block';
    
    // Fetch details via AJAX
    fetch(`get_details.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displaySubmissionDetails(data.submission);
            } else {
                modalContent.innerHTML = '<div class="error">Error loading details: ' + data.message + '</div>';
            }
        })
        .catch(error => {
            modalContent.innerHTML = '<div class="error">Error loading details: ' + error.message + '</div>';
        });
}

// Function to display submission details
function displaySubmissionDetails(submission) {
    const modalContent = document.getElementById('modalContent');
    
    const html = `
        <div class="detail-sections">
            <div class="detail-section">
                <h3><i class="fas fa-user"></i> Contact Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <strong>Name:</strong> ${submission.name}
                    </div>
                    <div class="detail-item">
                        <strong>Mobile:</strong> ${submission.mobile}
                    </div>
                    <div class="detail-item">
                        <strong>Email:</strong> ${submission.email}
                    </div>
                    <div class="detail-item">
                        <strong>City:</strong> ${submission.city}
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <h3><i class="fas fa-map"></i> Plot Details</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <strong>Shape:</strong> ${submission.plot_shape}
                    </div>
                    <div class="detail-item">
                        <strong>Length:</strong> ${submission.plot_length}
                    </div>
                    <div class="detail-item">
                        <strong>Width:</strong> ${submission.plot_width}
                    </div>
                    <div class="detail-item">
                        <strong>Radius:</strong> ${submission.plot_radius || 'N/A'}
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <h3><i class="fas fa-border-all"></i> Margins</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <strong>Right:</strong> ${submission.margin_right}
                    </div>
                    <div class="detail-item">
                        <strong>Left:</strong> ${submission.margin_left}
                    </div>
                    <div class="detail-item">
                        <strong>Back:</strong> ${submission.margin_back}
                    </div>
                    <div class="detail-item">
                        <strong>Front:</strong> ${submission.margin_front}
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <h3><i class="fas fa-compass"></i> Orientation</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <strong>Road Direction:</strong> ${submission.road_direction}
                    </div>
                    <div class="detail-item">
                        <strong>Front Facing:</strong> ${submission.front_facing}
                    </div>
                    <div class="detail-item">
                        <strong>Entry Gate:</strong> ${submission.entry_gate}
                    </div>
                    <div class="detail-item">
                        <strong>Main Door:</strong> ${submission.main_door}
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <h3><i class="fas fa-building"></i> Floor Requirements</h3>
                <div class="floor-details">
                    <h4>Ground Floor</h4>
                    <div class="floor-grid">
                        <span>Parking: ${submission.gf_parking}</span>
                        <span>Porch: ${submission.gf_porch}</span>
                        <span>Hall: ${submission.gf_hall}</span>
                        <span>Kitchen: ${submission.gf_kitchen}</span>
                        <span>Bedroom: ${submission.gf_bedroom}</span>
                        <span>Master Bedroom: ${submission.gf_master_bedroom}</span>
                        <span>Toilet: ${submission.gf_toilet}</span>
                        <span>Bathroom: ${submission.gf_bathroom}</span>
                    </div>
                    
                    <h4>First Floor</h4>
                    <div class="floor-grid">
                        <span>Parking: ${submission.ff_parking}</span>
                        <span>Porch: ${submission.ff_porch}</span>
                        <span>Hall: ${submission.ff_hall}</span>
                        <span>Kitchen: ${submission.ff_kitchen}</span>
                        <span>Bedroom: ${submission.ff_bedroom}</span>
                        <span>Master Bedroom: ${submission.ff_master_bedroom}</span>
                        <span>Toilet: ${submission.ff_toilet}</span>
                        <span>Bathroom: ${submission.ff_bathroom}</span>
                    </div>
                    
                    <h4>Second Floor</h4>
                    <div class="floor-grid">
                        <span>Parking: ${submission.sf_parking}</span>
                        <span>Porch: ${submission.sf_porch}</span>
                        <span>Hall: ${submission.sf_hall}</span>
                        <span>Kitchen: ${submission.sf_kitchen}</span>
                        <span>Bedroom: ${submission.sf_bedroom}</span>
                        <span>Master Bedroom: ${submission.sf_master_bedroom}</span>
                        <span>Toilet: ${submission.sf_toilet}</span>
                        <span>Bathroom: ${submission.sf_bathroom}</span>
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <h3><i class="fas fa-calculator"></i> Total Areas</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <strong>Ground Floor:</strong> ${submission.total_ground} sq ft
                    </div>
                    <div class="detail-item">
                        <strong>First Floor:</strong> ${submission.total_first} sq ft
                    </div>
                    <div class="detail-item">
                        <strong>Second Floor:</strong> ${submission.total_second} sq ft
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <h3><i class="fas fa-info-circle"></i> Submission Info</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <strong>Submitted:</strong> ${new Date(submission.submission_date).toLocaleString()}
                    </div>
                    <div class="detail-item">
                        <strong>Status:</strong> ${submission.status}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    modalContent.innerHTML = html;
}

// Function to update status
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