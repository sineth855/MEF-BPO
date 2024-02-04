<template>
  <vs-tabs position="top" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">
    <!-- 5 -->
    <vs-tab icon-pack="feather" icon="icon-edit" :label="!isSmallerScreen ? 'ព័ត៌មានរៀបចំថវិកា' : ''">
      <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-budget-arrangement />
      </div>
    </vs-tab>

    <!-- 3 -->
    <vs-tab icon-pack="feather" icon="icon-lock" :label="!isSmallerScreen ? 'សិទ្ធ និងអ្នកប្រើប្រាស់' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-role />
      </div>
    </vs-tab>

    <!-- 4 -->
    <vs-tab icon-pack="feather" icon="icon-settings" :label="!isSmallerScreen ? 'គណនេយ្យ និងរដ្ឋបាល' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-account-admin />
      </div>
    </vs-tab>

    <!-- 6 -->
    <vs-tab icon-pack="feather" icon="icon-user" :label="!isSmallerScreen ? 'អង្គភាព' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <vx-card>
          <setting-entity />
        </vx-card>
      </div>
    </vs-tab>

    <!-- 1 -->
    <vs-tab icon-pack="feather" icon="icon-edit" :label="!isSmallerScreen ? 'ពត៌មានទូទៅ' : ''">
      <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-general />
      </div>
    </vs-tab>

    <!-- 2 -->
    <vs-tab icon-pack="feather" icon="icon-users" :label="!isSmallerScreen ? 'រចនាសម្ព័ន្ធ' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-structure />
      </div>
    </vs-tab>



    <!-- 6 -->
    <vs-tab icon-pack="feather" icon="icon-calendar" :label="!isSmallerScreen ? 'រក្សាទុកទិន្នន័យ' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-backup />
      </div>
    </vs-tab>

    <!-- 7 -->
    <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'ការជូនដំណឹង' : ''">
      <div class="tab-text md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-notifications />
      </div>
    </vs-tab>

    <!-- 8 -->
    <vs-tab icon-pack="feather" icon="icon-lock" :label="!isSmallerScreen ? 'ប្តូរលេខសម្ងាត់' : ''">
      <div class="tab-change-pwd md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-change-password />
      </div>
    </vs-tab>

    <!-- <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? 'ពត៌មានបន្ថែម' : ''">
      <div class="tab-info md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-info />
      </div>
    </vs-tab> -->

    <!-- <vs-tab icon-pack="feather" icon="icon-github" :label="!isSmallerScreen ? 'បណ្តាញសង្គម' : ''">
      <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
        <setting-social-links />
      </div>
    </vs-tab> -->

    <!-- 9 -->
    <vs-tab icon-pack="feather" icon="icon-clock" :label="!isSmallerScreen ? 'កំណត់ហេតុប្រព័ន្ធ' : ''">
      <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
        <vs-table :data="[]" style="overflow: scroll">

          <vs-tr :state="'warning'">
            <vs-td>អ្នកប្រប្រាស់</vs-td>
            <vs-td>IP Address</vs-td>
            <vs-td>ភ្នាក់ងារអ្នកប្រើប្រាស់</vs-td>
            <vs-td>សកម្មភាព</vs-td>
            <vs-td>កាលបរិច្ឆេទប្រតិបត្តិការ</vs-td>
          </vs-tr>

          <vs-tr>
            <vs-td>Admistrator</vs-td>
            <vs-td>192.168.0.1</vs-td>
            <vs-td>Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0
              Safari/537.36</vs-td>
            <vs-td>អ្នកប្រើប្រាស់ បានចូលប្រព័ន្ធ</vs-td>
            <vs-td> 07-12-2022 14:29</vs-td>
          </vs-tr>

          <vs-tr>
            <vs-td>Admistrator</vs-td>
            <vs-td>192.168.0.1</vs-td>
            <vs-td>Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0
              Safari/537.36</vs-td>
            <vs-td>អ្នកប្រើប្រាស់ បានបង្កើតឈ្មោះអ្នកប្រើប្រាស់ប្រព័ន្ធថ្មី</vs-td>
            <vs-td> 07-12-2022 14:29</vs-td>
          </vs-tr>

        </vs-table>
      </div>
    </vs-tab>

  </vs-tabs>
</template>

<script>
import SettingGeneral from "./SettingGeneral.vue"
import SettingChangePassword from "./SettingChangePassword.vue"
import SettingBackup from "./SettingBackup.vue"
import SettingStructure from "./SettingStructure.vue"
import SettingInfo from "./SettingInfo.vue"
import SettingRole from "./SettingRole.vue"
import SettingAccountAdmin from "./SettingAccountAdmin.vue"
import SettingSocialLinks from "./SettingSocialLinks.vue"
import SettingNotifications from "./SettingNotifications.vue"
import SettingEntity from "./SettingEntity.vue"
import SettingBudgetArrangement from "./SettingBudgetArrangement.vue"

export default {
  components: {
    SettingGeneral,
    SettingChangePassword,
    SettingBackup,
    SettingAccountAdmin,
    SettingStructure,
    SettingInfo,
    SettingRole,
    SettingSocialLinks,
    SettingNotifications,
    SettingEntity,
    SettingBudgetArrangement
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
