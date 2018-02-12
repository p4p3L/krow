{@header}
<main id="main" class="homepage wrapper">
	<div class="login wrapper">
		<div class="container">
			<?php if (user()->isOnline()) { echo '<p>Oturumunuz zaten açık</p>'; } ?>
			<?php if ($login_response == false){ echo "<p>$login_message</p>"; } ?>
			<form id="loginForm" method="post" action="/krow/user/login">
				<div class="wrapper">
					<input class="text-input" type="text" name="username" placeholder="Kullanıcı Adı">
				</div>
				<div class="wrapper">
					<input class="text-input" type="text" name="password" placeholder="Şifre...">
				</div>
				<input class="button" type="submit" value="Giriş Yap">
			</form>

		</div>
	</div>
</main>
{@footer}