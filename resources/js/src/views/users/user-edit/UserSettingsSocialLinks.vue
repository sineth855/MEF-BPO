<template>
  <vx-card no-shadow>

    <vs-input class="w-full mb-base" v-model="twitter" icon-pack="feather" icon="icon-twitter" label="GitHub" icon-no-border />
    <vs-input class="w-full mb-base" v-model="facebook" icon-pack="feather" icon="icon-facebook" label="GitHub" icon-no-border />
    <vs-input class="w-full mb-base" v-model="instagram" icon-pack="feather" icon="icon-instagram" label="GitHub" icon-no-border />
    <vs-input class="w-full mb-base" v-model="github" icon-pack="feather" icon="icon-github" label="GitHub" icon-no-border />
    <vs-input class="w-full mb-base" v-model="linkedin" icon-pack="feather" icon="icon-linkedin" label="GitHub" icon-no-border />
    <vs-input class="w-full mb-base" v-model="slack" icon-pack="feather" icon="icon-slack" label="GitHub" icon-no-border />

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2">រក្សាទុក</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
  </vx-card>
</template>

<script>
export default {
  data() {
    return {
      twitter: "",
      facebook: "",
      instagram: "",
      github: "",
      linkedin: "",
      slack: "",
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    },
  }
}
</script>
