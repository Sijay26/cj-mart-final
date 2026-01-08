<?php require 'header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Register</h2>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 'exists'): ?>
            <p style="color: red; margin-bottom: 15px;">Username already taken. Try another.</p>
        <?php endif; ?>
        
        <form action="authenticate.php?action=register" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Choose a unique Username" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Min 6 characters" minlength="6" required>
            </div>
            
            <button type="submit" class="btn">Register</button>
            
            <p style="margin-top: 20px;">
                Already have an account? <a href="login.php" class="link">Login Here</a>
            </p>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>
