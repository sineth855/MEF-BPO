<template>
  <vx-card no-shadow>

    <div class="mb-base">
      <h3 class="mb-4">កំពុងស្ថិតក្នុងការត្រួតពិនិត្យ</h3>
    </div>

    <!-- Save & Reset Button -->
    <!-- <div class="flex flex-wrap items-center justify-end mt-base">
      <vs-button class="ml-auto mt-2">រក្សាទុក</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div> -->

  </vx-card>
</template>

<script>
export default {
  data() {
    return {
      
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    },
  }
}
</script>
