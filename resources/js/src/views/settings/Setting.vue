<template>

  <vs-tabs :position="isSmallerScreen ? 'top' : 'left'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">
    <!-- GENERAL -->
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'គណនេយ្យ និងរដ្ឋបាល' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-account-admin />
      </div>
    </vs-tab>
    
    <vs-tab icon-pack="feather" icon="icon-user" :label="!isSmallerScreen ? 'ពត៌មានទូទៅ' : ''">
      <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-general />
      </div>
    </vs-tab>
    
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'សិទ្ធ និងអ្នកប្រើប្រាស់' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <user-settings-notifications />
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'រចនាសម្ព័ន្ធ' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <user-settings-notifications />
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'អង្គភាព' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <user-settings-notifications />
      </div>
    </vs-tab>
    <!-- <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'គណនេយ្យ និងរដ្ឋបាល' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-account-admin />
      </div>
    </vs-tab> -->
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'ទិន្នន័យ Backup' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <user-settings-notifications />
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'ការជូនដំណឹង' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <user-settings-notifications />
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-lock" :label="!isSmallerScreen ? 'ប្តូរលេខសម្ងាត់' : ''">
      <div class="tab-change-pwd md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-change-password />
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? 'ពត៌មានបន្ថែម' : ''">
      <div class="tab-info md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-info />
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-github" :label="!isSmallerScreen ? 'បណ្តាញសង្គម' : ''">
      <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
        <user-settings-social-links />
      </div>
    </vs-tab>
  </vs-tabs>
</template>

<script>
import SettingGeneral from "./SettingGeneral.vue"
import SettingChangePassword from "./SettingChangePassword.vue"
import SettingInfo from "./SettingInfo.vue"
import SettingAccountAdmin from "./SettingAccountAdmin.vue"
import SettingSocialLinks from "./SettingSocialLinks.vue"
import SettingNotifications from "./SettingNotifications.vue"

export default {
  components: {
    SettingGeneral,
    SettingChangePassword,
    SettingAccountAdmin,
    SettingInfo,
    SettingSocialLinks,
    SettingNotifications,
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

<style lang="scss">
#profile-tabs {
  .vs-tabs--content {
    padding: 0;
  }
}
</style>
