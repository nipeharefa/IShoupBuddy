<template>
  <input class="input is-small in-quan"
    type="tel"
    placeholder="Quantity"
    :value="amountValue"
    v-model="amount"
    @input="processValue(amountValue)"
    >
</template>


<script>

  export default {
    model: {
        prop: 'rating',
        event: 'rating-selected'
    },
    props: {
      rating: {
        required: true
      }
    },
    created() {
      this.amount = this.rating
    },
    data: () => ({
      amount: ''
    }),
    computed: {
      amountValue () {
        return this.formatToNumber(this.amount)
      }
    },
    watch: {
      rating(a) {
        this.amount = a
      },
      amount(a, b) {
        console.log(a)
        this.updateParent(a)
      }
    },
    methods: {
      updateQuantity () {
        console.log('alskdfjksdjflk')
      },
      updateParent(a) {
        this.$emit('rating-selected')
        this.$emit('update:rating', a)
      },
      formatToNumber (value) {
        let number = 0
        if (this.separator === '.') {
          let cleanValue = value
          if (typeof value !== 'string') {
            cleanValue = this.numberToString(value)
          }
          number = Number(String(cleanValue).replace(/[^0-9-,]+/g, '').replace(',', '.'))
        } else {
          number = Number(String(value).replace(/[^0-9-.]+/g, ''))
        }
        if (!this.minus) return Math.abs(number)
        return number
      },
      processValue(value){
        if (isNaN(value)) {
          this.amount = 1
          return
        } else if (value === 0) {
          this.amount = 1
        } else {
          this.amount = value
        }
      }
    }
  }
</script>
