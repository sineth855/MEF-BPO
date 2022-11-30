<template>
  <div>Put your data here</div>
</template>

<script>
    export default {
        components: {
            
        },
        data() {
            return {
            
            }
        },
        computed: {
            isSmallerScreen() {
            return this.$store.state.windowWidth < 768
            }
        }
    }
</script>