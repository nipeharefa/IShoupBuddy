<template>
	<div class="footer">
		<div class="container">
			<div class="columns">
				<div class="column ">
					<div class="footer-logo-columns">
						<h1 class="title is-4">
							IshoupBuddy
						</h1>
					</div>
				</div>
				<div class="column">
					<ul class="menu-footer-2">
						<li>
							<a href="">Syarat dan Ketentuan</a>
						</li>
						<li>
							<a href="">Kebijakan Privasi</a>
						</li>
						<li>
							<a href="">Berita dan Pengumuman</a>
						</li>
						<li>
							<a href="">Tentang Kami</a>
						</li>
					</ul>
				</div>
				<div class="column">
					<div>
						<div class="columns">
							<div class="column">
								<div class="center">
									<p class="footer-text-info">Temukan kami di </p>
								</div>
								<div class="center">
									<p class="footer-text-info">Lebih mudah review dan belanja di Aplikasi ShoupBuddy </p>
								</div>
								<div class="field">
									<p class="control">
										<input type="text" placeholder="Nomor Handphone" class="input">
									</p>
									<p class="controls">
										<button class="button is-primary btn-send-link">Kirim Link</button>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<style lang="scss">
	.footer-logo-columns {
		align-items: center;
		display: flex;
		justify-content: center;
		height: 100%;
	}
	.footer-text-info {
		font-size: 0.8rem;
	}
	.menu-footer-2 {
		display: flex;
		flex-direction: column;
		li {
			a {
				font-size: 0.8rem;
			}
		}
	}
	.btn-send-link {
		width: 100%;
	}
</style>