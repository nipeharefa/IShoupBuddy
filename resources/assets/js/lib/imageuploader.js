const upload =  (Vue, e) => {
  const file = e.target.files[0]
  const fileName = file.name.toLowerCase()

  return new Promise((resolve, reject) => {
    if (!(file && fileName.match(/\.(jpg|jpeg|png|gif)$/))) {
      reject('null')
    }

    if (file.size > 3000000) {
      reject('tobig')
    }

    const formData = new FormData()
    formData.append('image', file)
    console.log(Vue)
    Vue.$http.post('api/image', formData).then(response => {
      resolve(response)
    }).catch(error => {
      reject(err)
    })
  })
}

export default (Vue) => {
  Object.defineProperties(Vue.prototype, {
    $uploader: {
      get () {
        return {
          nipe: x => {
            return upload(this, x)
          }
        }
      }
    }
  })
}
