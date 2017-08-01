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
								<div class="center socialbox">
									<p class="footer-text-info">Temukan kami di </p>
									<i class="fa fa-facebook"></i>
									<i class="fa fa-twitter"></i>
								</div>
								<div class="center">
									<p class="footer-text-info">Lebih mudah review dan belanja di Aplikasi ShoupBuddy </p>
								</div>

                <div class="field" v-if="!sent">
									<p class="control control-input-phone">
										<input type="text" placeholder="Nomor Handphone" class="input" v-model="phone">
									</p>
									<p class="controls">
										<button class="button is-primary btn-send-link" @click="sendLink">Kirim Link</button>
									</p>
								</div>
                <div class="field success-sent" v-if="sent">
                  <small>Berhasil! Silakan cek handphone Anda untuk tautan download</small>
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
  .success-sent {
    margin: 1rem 0;
    small {
      color: green;
      font-weight: 400;
    }
  }
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
	.control-input-phone {
		margin-bottom: 1rem;
	}
	.socialbox {
		display: flex;
		flex-direction: row;

		p {
			margin-right: 8px;
		}
		i {
			margin-right: 0.5rem;
		}
	}
</style>

<script>
  export default {
    data() {
      return {
        phone: '',
        sent: false
      }
    },
    methods: {
      sendLink ($event) {
        const btn = event.target
        const data = {
          phone: this.phone
        }
        btn.classList.add('is-loading')
        this.$http.post('sms', data)
          .then(response => {
            this.sent = true
            btn.classList.remove('is-loading')
          })
          .catch(err => err)
      }
    }
  }
</script>
