<?php require 'header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Login</h2>
        
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'registered'): ?>
            <p style="color: green; margin-bottom: 15px;">Registration successful! Please login.</p>
        <?php endif; ?>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
            <p style="color: red; margin-bottom: 15px;">Invalid Username or Password.</p>
        <?php endif; ?>

        <form action="authenticate.php?action=login" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
            
            <a href="register.php" class="btn btn-outline" style="margin-top: 15px; display: inline-block; background: white; color: var(--primary-color); text-align: center;">Go to Register</a>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>
