new Vue({
  el: '#app',
  data: () => ({
    drawer: null,
    user: null,
    password: null
  }),
  props: {
    source: String
  }
})