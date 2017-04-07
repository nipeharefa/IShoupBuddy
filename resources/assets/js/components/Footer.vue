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
							<a href="">Tentang Kami</a>
						</li>
						<li>
							<a href="">Cara Berbelanja</a>
						</li>
						<li>
							<a href="">Hubungi Kami</a>
						</li>
					</ul>
				</div>
				<div class="column">
					<div>
						<div class="columns">
							<div class="column">
								<div class="field">
									<p class="control">
										<input type="text" placeholder="Nomor Handphone" class="input">
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
	.menu-footer-2 {
		display: flex;
		flex-direction: column;
		align-items: center;

		li {
			a {
				font-size: 0.8rem;
			}
		}
	}
</style>