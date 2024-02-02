<template>
  <vx-card no-shadow>

    <!-- Img Row -->
    <div class="flex flex-wrap items-center mb-base">
      <vs-avatar :src="activeUserInfo.photoURL" size="70px" class="mr-4 mb-4" />
      <div>
        <vs-button class="mr-4 sm:mb-0 mb-2">Upload photo</vs-button>
        <vs-button type="border" color="danger">Remove</vs-button>
        <p class="text-sm mt-2">Allowed JPG, GIF or PNG. Max size of 800kB</p>
      </div>
    </div>

    <!-- Info -->
    <vs-input class="w-full mb-base" label-placeholder="config_name" v-model="config_name"></vs-input>
    <vs-input class="w-full mb-base" label-placeholder="config_owner" v-model="config_owner"></vs-input>
    <vs-input class="w-full" label-placeholder="config_address" v-model="config_address"></vs-input>
    <vs-input class="w-full my-base" label-placeholder="config_address" v-model="config_address"></vs-input>

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2">{{ $t('btn_update') }}</vs-button>
    </div>

  </vx-card>
</template>

<script>
export default {
  data() {
    return {
      config_name: ""
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    },
  }
}
</script>
