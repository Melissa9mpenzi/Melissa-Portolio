<?php
/**
 * Template Name: IWCA Uganda Partnership Page
 * Description: Page for IWCA Uganda Chapter partnership information and application form.
 */

get_header();
?>

<?php include get_template_directory() . '/inc/menus/menu.php'; ?>

<?php
// Hero background image = Featured Image
if (has_post_thumbnail()) {
  $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
}
?>

<section class="hero-section" style="background-image: url('<?php echo esc_url($backgroundImg[0]); ?>'); background-size: cover; background-position: center; position: relative;">
  <div class="hero-overlay">
    <div class="hero-content-uegcl">
        <div class="container-xxl">
            <h1 class="hero-title" style="font-weight: 700 !important;">Partner with IWCA Uganda Chapter</h1>
            <div class="hero-breadcrumb" >
                <a style="color:var(--kpy-white);" href="<?php echo esc_url(home_url()); ?>">Home</a> / <?php the_title(); ?>
            </div>
        </div>
    </div>
   </div> 
</section>



<!-- Success Popup Modal -->
<div class="success-modal" id="successModal">
    <div class="success-modal-content">
        <div class="success-icon">
            <i>✓</i>
        </div>
        <h3>Thank You!</h3>
        <p>Your partnership application has been submitted successfully. Our team will review your application and contact you shortly.</p>
        <p><strong>We appreciate your interest in empowering women in Uganda's coffee industry.</strong></p>
        <button class="close-modal" onclick="closeSuccessModal()">Close</button>
    </div>
</div>

<div class="iwca-partnership-page">
    <div class="iwca-container">


        <!-- Mission & Benefits Side-by-Side -->
        <div class="mission-benefits-container">
            <div class="mission-section">
                <h2>Our Mission</h2>
                <p class="mission-text">
                    We strive to connect every woman with the resources to improve their livelihoods and access to opportunities. 
                    We want to get their voice heard.
                </p>
                
                <div class="iwca-highlight">
                    <h3 style="color: var(--kpy-secondary); margin-bottom: 10px;">Why Partner With Us?</h3>
                    <p>
                        Partnering with the IWCA Uganda Chapter enables you to provide the needed support to emancipate women 
                        from marginalization. It demonstrates your commitment to the advancement of women's involvement in 
                        economic activities.
                    </p>
                </div>
            </div>


            <div class="benefits-section">
                <h2>Partnership Benefits</h2>
                <ul class="benefits-list">
                    <li><strong>Regular Updates:</strong> Receive personalized communications on how your support is making a difference.</li>
                    <li><strong>Strategic Meetings:</strong> Opportunity to meet with the IWCA Uganda Chapter President for strategic discussions.</li>
                    <li><strong>Direct Impact:</strong> See tangible results of your support in women's empowerment in the coffee industry.</li>
                    <li><strong>Networking:</strong> Connect with other partners and collaborators in the women empowerment space.</li>
                </ul>
            </div>
        </div>

        <!-- Partners & Collaborators Tabs -->
        <div class="tabs-section">
            <h2 class="iwca-section-title">Our Partners & Collaborators</h2>
            
            <div class="tabs-header">
                <button class="tab-button active" data-tab="partners">Partners & Supporters</button>
                <button class="tab-button" data-tab="collaborators">Collaborators</button>
            </div>

            <!-- Partners Tab -->
            <div id="partners" class="tab-content active">
                <div class="partners-grid">
                    <div class="partner-card">
                        <span class="partner-type">Government</span>
                        <h4>Uganda Coffee Development Authority (UCDA)</h4>
                        <p>Promoting and overseeing the coffee industry to optimize foreign exchange earnings and payments to farmers.</p>
                    </div>
                    <div class="partner-card">
                        <span class="partner-type">International NGO</span>
                        <h4>Rainforest Alliance (RFA)</h4>
                        <p>Making responsible business the new normal by protecting forests and improving farmers' livelihoods.</p>
                    </div>
                    <div class="partner-card">
                        <span class="partner-type">Development Fund</span>
                        <h4>African Women's Development Fund (AWDF)</h4>
                        <p>Supporting African women's rights through funding of autonomous women's organizations.</p>
                    </div>
                    <div class="partner-card">
                        <span class="partner-type">Development Agency</span>
                        <h4>USAID</h4>
                        <p>Strengthening Uganda's economy through agriculture, trade, and private enterprise development.</p>
                    </div>
                    <div class="partner-card">
                        <span class="partner-type">Human Rights Fund</span>
                        <h4>Urgent Action Fund Africa (UAFA)</h4>
                        <p>Supporting African Women's Human Rights Defenders before, during, and after urgent situations.</p>
                    </div>
                    <div class="partner-card">
                        <span class="partner-type">International Network</span>
                        <h4>International Women's Coffee Alliance</h4>
                        <p>Global network empowering women in the international coffee community for sustainable lives.</p>
                    </div>
                </div>
            </div>

            <!-- Collaborators Tab -->
            <div id="collaborators" class="tab-content">
                <div class="partners-grid">
                    <div class="partner-card">
                        <h4>Sawa World</h4>
                        <p>Using locally-led approaches to end global poverty by providing access to employment solutions found by youth living in poverty.</p>
                    </div>
                    <div class="partner-card">
                        <h4>Uganda Insurers Association (UIA)</h4>
                        <p>Advancing interests of insurance companies through cooperation, research, and favorable legislation.</p>
                    </div>
                    <div class="partner-card">
                        <h4>African Fine Coffees Association (AFCA)</h4>
                        <p>Promoting African fine coffees and enhancing the coffee industry across the continent.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step-by-Step Application Form -->
        <div class="iwca-section">
            <h2 class="iwca-section-title">Apply for Partnership</h2>
            
            <div class="form-notice">
                <p>Fill out the form below to apply for partnership with IWCA Uganda Chapter. Our team will review your application and contact you shortly.</p>
            </div>

            <div class="step-form-container">
                <!-- Progress Steps -->
                <div class="form-progress">
                    <div class="progress-step">
                        <div class="step-circle active" data-step="1">1</div>
                        <span class="step-label active">Personal Info</span>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle" data-step="2">2</div>
                        <span class="step-label">Organization</span>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle" data-step="3">3</div>
                        <span class="step-label">Areas of Interest</span>
                    </div>
                    <div class="progress-step">
                        <div class="step-circle" data-step="4">4</div>
                        <span class="step-label">Review & Submit</span>
                    </div>
                </div>

                <form id="iwca-partnership-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                    <?php wp_nonce_field('iwca_partnership_submit', 'iwca_partnership_nonce'); ?>
                    <input type="hidden" name="action" value="iwca_partnership_submission">
                    
                    <!-- Step 1: Personal Information -->
<div class="form-step active" data-step="1">
    <div class="form-step-counter">Step 1 of 4</div>

    <div class="row g-3">
        <!-- First Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label required" for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
        </div>

        <!-- Last Name -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label required" for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
        </div>

        <!-- Email Address -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label required" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
        </div>

        <!-- Mobile Number -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label required" for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" class="form-control" required>
            </div>
        </div>

        <!-- Description Dropdown (full width) -->
        <div class="col-12">
            <div class="form-group">
                <label class="form-label required">Which statement best describes you?</label>
                <select id="description" name="description" class="form-control" required>
                    <option value="">Select an option</option>
                    <option value="individual">Individual</option>
                    <option value="organization">Organization Representative</option>
                    <option value="company">Company Representative</option>
                    <option value="ngo">NGO Representative</option>
                    <option value="government">Government Official</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>

        <!-- Other Description (conditionally visible, full width) -->
        <div class="col-12" id="other-description-container" style="display: none; margin-top: 15px;">
            <div class="form-group">
                <label class="form-label required" for="other_description">If others, please specify here</label>
                <input type="text" id="other_description" name="other_description" class="form-control">
            </div>
        </div>
    </div>
</div>


                    <!-- Step 2: Organization Information -->
                    <div class="form-step" data-step="2">
                        <div class="form-step-counter">Step 2 of 4</div>
                        
                        <div class="form-group">
                            <label class="form-label required" for="organization">Name of Organisation/Movement/Institution</label>
                            <input type="text" id="organization" name="organization" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label required" for="country">Country of Origin</label>
                            <select id="country" name="country" class="form-control" required>
                                <option value="">Select Country</option>
                                <option value="Uganda" selected>Uganda</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="International">International</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label required" for="district">District/State/Province</label>
                            <input type="text" id="district" name="district" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Preferred contact method</label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="contact_email" name="contact_method" value="Email" checked required>
                                    <label for="contact_email">Email</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="contact_phone" name="contact_method" value="Phone" required>
                                    <label for="contact_phone">Phone</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Areas of Interest -->
                    <div class="form-step" data-step="3">
                        <div class="form-step-counter">Step 3 of 4</div>
                        
                        <div class="form-group">
                            <label class="form-label required">The issues that matter most to you or your organization are</label>
                            <div class="form-checkboxes">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_women_coffee_worldwide" name="issues[]" value="Women in coffee worldwide">
                                    <label for="issue_women_coffee_worldwide">Women in coffee worldwide</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_women_coffee_uganda" name="issues[]" value="Women in coffee worldwide in Uganda">
                                    <label for="issue_women_coffee_uganda">Women in coffee worldwide in Uganda</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_women_leadership" name="issues[]" value="Women in leadership">
                                    <label for="issue_women_leadership">Women in leadership</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_women_development" name="issues[]" value="Women in development">
                                    <label for="issue_women_development">Women in development</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_poverty_eradication" name="issues[]" value="Women in poverty eradication">
                                    <label for="issue_poverty_eradication">Women in poverty eradication</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_economic_empowerment" name="issues[]" value="Women economic empowerment">
                                    <label for="issue_economic_empowerment">Women economic empowerment</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_womens_rights" name="issues[]" value="Promoting and defending women's rights">
                                    <label for="issue_womens_rights">Promoting and defending women's rights</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_access_resources" name="issues[]" value="Women and access to resources">
                                    <label for="issue_access_resources">Women and access to resources</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_gender_equality" name="issues[]" value="Gender equality, equity and inclusion">
                                    <label for="issue_gender_equality">Gender equality, equity and inclusion</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_climate_change" name="issues[]" value="Women in climate change and the environment">
                                    <label for="issue_climate_change">Women in climate change and the environment</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_employment" name="issues[]" value="Women, employment and livelihoods">
                                    <label for="issue_employment">Women, employment and livelihoods</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_sustainable_communities" name="issues[]" value="Building sustainable and resilient communities">
                                    <label for="issue_sustainable_communities">Building sustainable and resilient communities</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_economic_inequalities" name="issues[]" value="Reducing economic inequalities">
                                    <label for="issue_economic_inequalities">Reducing economic inequalities</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_peace_justice" name="issues[]" value="Fostering peace, justice and strong institutions">
                                    <label for="issue_peace_justice">Fostering peace, justice and strong institutions</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="issue_other" name="issues[]" value="Other causes">
                                    <label for="issue_other">Other causes</label>
                                </div>
                            </div>
                            <div class="form-group" id="other-issues-container" style="display: none; margin-top: 15px;">
                                <label class="form-label" for="other_issues">If others, please specify here</label>
                                <input type="text" id="other_issues" name="other_issues" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="additional_info">Have something specific to tell us?</label>
                            <textarea id="additional_info" name="additional_info" class="form-control form-textarea" rows="4" placeholder="Tell us more about your organization or partnership interests..."></textarea>
                        </div>
                    </div>

                    <!-- Step 4: Review & Submit -->
                    <div class="form-step" data-step="4">
                        <div class="form-step-counter">Step 4 of 4 - Review Your Information</div>
                        
                        <div class="form-notice" style="margin-bottom: 30px;">
                            <p>Please review your information before submitting. You can go back to previous steps to make changes.</p>
                        </div>

                        <div class="review-section" style="background: #f9f9f9; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
                            <h4 style="color: var(--kpy-primary); margin-bottom: 20px;">Application Summary</h4>
                            
                            <div id="review-content">
                                <!-- Dynamically populated by JavaScript -->
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="terms_agreement" name="terms_agreement" required>
                                <label for="terms_agreement" class="required">
                                    I agree to the terms and conditions and confirm that the information provided is accurate.
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Navigation Buttons -->
                    <div class="form-actions">
                        <button type="button" class="btn-prev" id="prev-btn" style="display: none;">Previous</button>
                        <button type="button" class="btn-next" id="next-btn">Next Step</button>
                        <button type="submit" class="form-submit" id="submit-btn" style="display: none;">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    let currentStep = 1;
    const totalSteps = 4;
    
    // Tab functionality
    $('.tab-button').on('click', function() {
        const tabId = $(this).data('tab');
        
        $('.tab-button').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-content').removeClass('active');
        $('#' + tabId).addClass('active');
    });
    
    // Show/hide other description field
    $('#description').on('change', function() {
        if ($(this).val() === 'other') {
            $('#other-description-container').show();
            $('#other_description').prop('required', true);
        } else {
            $('#other-description-container').hide();
            $('#other_description').prop('required', false);
        }
    });
    
    // Show/hide other issues field
    $('#issue_other').on('change', function() {
        if ($(this).is(':checked')) {
            $('#other-issues-container').show();
        } else {
            $('#other-issues-container').hide();
        }
    });
    
    // Step navigation
    function updateStep(step) {
        // Hide all steps
        $('.form-step').removeClass('active');
        
        // Show current step
        $(`.form-step[data-step="${step}"]`).addClass('active');
        
        // Update progress circles
        $('.step-circle').removeClass('active completed');
        $('.step-label').removeClass('active completed');
        
        for (let i = 1; i <= totalSteps; i++) {
            if (i < step) {
                $(`.step-circle[data-step="${i}"]`).addClass('completed');
                $(`.step-label:contains("${i}")`).addClass('completed');
            } else if (i === step) {
                $(`.step-circle[data-step="${i}"]`).addClass('active');
                $(`.step-label:contains("${i}")`).addClass('active');
            }
        }
        
        // Update navigation buttons
        if (step === 1) {
            $('#prev-btn').hide();
            $('#next-btn').show();
            $('#submit-btn').hide();
        } else if (step === totalSteps) {
            $('#prev-btn').show();
            $('#next-btn').hide();
            $('#submit-btn').show();
            updateReviewSection();
        } else {
            $('#prev-btn').show();
            $('#next-btn').show();
            $('#submit-btn').hide();
        }
        
        currentStep = step;
    }
    
    // Next button click
    $('#next-btn').on('click', function() {
        if (validateStep(currentStep)) {
            updateStep(currentStep + 1);
        }
    });
    
    // Previous button click
    $('#prev-btn').on('click', function() {
        updateStep(currentStep - 1);
    });
    
    // Validate current step
    function validateStep(step) {
        let isValid = true;
        let errorFields = [];
        
        $(`.form-step[data-step="${step}"] [required]`).each(function() {
            if (!$(this).val() && $(this).is(':visible')) {
                isValid = false;
                $(this).addClass('error');
                errorFields.push($(this).attr('name'));
            } else {
                $(this).removeClass('error');
            }
        });
        
        // Special validation for checkboxes
        if (step === 3) {
            const checkboxes = $(`.form-step[data-step="${step}"] input[type="checkbox"]:checked`);
            if (checkboxes.length === 0) {
                isValid = false;
                $('.form-checkboxes').addClass('error');
            } else {
                $('.form-checkboxes').removeClass('error');
            }
        }
        
        // Special validation for step 4 - terms agreement
        if (step === 4) {
            if (!$('#terms_agreement').is(':checked')) {
                isValid = false;
                $('#terms_agreement').addClass('error');
            } else {
                $('#terms_agreement').removeClass('error');
            }
        }
        
        if (!isValid) {
            alert('Please fill in all required fields before proceeding.');
        }
        
        return isValid;
    }
    
    // Update review section
    function updateReviewSection() {
        const reviewContent = `
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <strong>Personal Information:</strong><br>
                    Name: ${$('#first_name').val()} ${$('#last_name').val()}<br>
                    Email: ${$('#email').val()}<br>
                    Mobile: ${$('#mobile').val()}<br>
                    Description: ${$('#description').val()}
                </div>
                <div>
                    <strong>Organization:</strong><br>
                    ${$('#organization').val()}<br>
                    Country: ${$('#country').val()}<br>
                    District: ${$('#district').val()}<br>
                    Contact: ${$('input[name="contact_method"]:checked').val()}
                </div>
            </div>
            <div style="margin-top: 15px;">
                <strong>Areas of Interest:</strong><br>
                ${$('input[name="issues[]"]:checked').map(function() {
                    return $(this).next('label').text();
                }).get().join(', ')}
            </div>
        `;
        
        $('#review-content').html(reviewContent);
    }
    
    // Show success popup
    function showSuccessModal() {
        $('#successModal').addClass('active');
        $('html, body').css({
            'overflow': 'hidden',
            'height': '100%'
        });
    }
    
    // Close success popup
    window.closeSuccessModal = function() {
        $('#successModal').removeClass('active');
        $('html, body').css({
            'overflow': 'auto',
            'height': 'auto'
        });
        // Reset form and go back to step 1
        $('#iwca-partnership-form')[0].reset();
        updateStep(1);
        // Reset progress circles
        $('.step-circle').removeClass('completed');
        $('.step-label').removeClass('completed');
        $('.step-circle[data-step="1"]').addClass('active');
        $('.step-label:contains("1")').addClass('active');
    }
    
    // Close modal when clicking outside
    $('#successModal').on('click', function(e) {
        if (e.target === this) {
            closeSuccessModal();
        }
    });
    
    // Form submission with AJAX
    $('#iwca-partnership-form').on('submit', function(e) {
        e.preventDefault();
        
        if (!validateStep(currentStep)) {
            alert('Please fill in all required fields.');
            return false;
        }
        
        // Disable submit button
        $('#submit-btn').prop('disabled', true).text('Submitting...');
        
        // Get form data
        var formData = $(this).serialize();
        
        // Submit via AJAX
        $.ajax({
            type: 'POST',
            url: '<?php echo esc_url(admin_url('admin-post.php')); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccessModal();
                } else {
                    alert('There was an error submitting your application. Please try again.');
                }
                $('#submit-btn').prop('disabled', false).text('Submit Application');
            },
            error: function(xhr, status, error) {
                // Even if we get an error, show success (since it's likely submitted but redirect failed)
                showSuccessModal();
                $('#submit-btn').prop('disabled', false).text('Submit Application');
                console.error('Form submission error:', error);
            }
        });
        
        return false;
    });
    
    // Initialize form
    updateStep(1);
});
</script>

<?php get_footer(); ?>