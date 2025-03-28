<?php get_header(); ?>

<style>
    .error-404 {
        min-height: calc(100vh - 200px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 6rem 1rem;
        text-align: center;
        background-color: var(--white);
    }
    
    .error-404 .image-container {
        max-width: 680px;
        margin: 0 auto 2rem;
        width: 100%;
    }
    
    .error-404 .error-message {
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .error-404 h2 {
        font-family: 'Libre Baskerville', serif;
        color: var(--romance);
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }
    
    .error-404 p {
        font-family: 'Inter', sans-serif;
        color: var(--mirage);
        font-size: 1.25rem;
        line-height: 1.6;
        margin-bottom: 2.5rem;
    }
    
    .error-404 .home-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 38px;
        padding: 0 1.5rem;
        border-radius: 16px;
        background-color: var(--romance);
        color: var(--white);
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    @media screen and (max-width: 768px) {
        .error-404 {
            padding: 4rem 1rem;
            min-height: calc(100vh - 150px);
        }
        
        .error-404 .image-container {
            max-width: 90%;
            margin-bottom: 1.5rem;
        }
        
        .error-404 h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .error-404 p {
            font-size: 1rem;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }
    }
    
    @media screen and (max-width: 480px) {
        .error-404 {
            padding: 3rem 1rem;
        }
        
        .error-404 .image-container {
            max-width: 100%;
            margin-bottom: 1rem;
        }
        
        .error-404 h2 {
            font-size: 1.75rem;
        }
        
        .error-404 p {
            font-size: 0.95rem;
            padding: 0 0.5rem;
        }
        
        .error-404 .home-button {
            width: 100%;
            max-width: 280px;
        }
    }
</style>

<section class="error-404">
    <div class="page-content">
        <div class="image-container">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.svg" alt="404 Error" style="width: 100%; height: auto;">
        </div>
        
        <div class="error-message">
            <h2>Page Not Found</h2>
            <p>We couldn't find the page you were looking for. It might have been moved or doesn't exist.</p>
            
            <a href="<?php echo esc_url(home_url('/')); ?>" class="secondary-button-salem secondary-button home-button">
                <span class="secondary-button-salem-text">Return to Home</span>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?> 