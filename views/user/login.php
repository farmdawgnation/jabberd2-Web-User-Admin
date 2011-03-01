	<div id="login_box">
		<p>
			To log into jabberd2-webuseradmin, please enter your
			full JID and Jabber password to authenticate. Remember, you
			must be listed as an administrator to authenticate successfully.
		</p>
		
		<? if(isset($error)) { ?>
		<p class="error">
			<?= $error ?>
		</p>
		<? } ?>
		
		<noscript>
			<p class="error">
				You do not have javascript enabled on this browser. Javascript
				is required to authenticate successfully with this server.
			</p>
		</noscript>
		
		<form method="post">
			<div class="field">
				<label for="username">Username:</label>
				<input type="text" name="username" />
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" />
			</div>
			<div class="submit">
				<input id="login_submit" type="submit" value="Log In" />
			</div>
		</form>
	</div>