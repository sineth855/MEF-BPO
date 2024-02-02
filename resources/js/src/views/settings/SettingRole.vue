<template>
  <vx-card>
    <div class="mt-5">
      <vs-tabs alignment="center">

        <vs-tab :label="$t('setting_user')">
          <user></user>
        </vs-tab>

        <vs-tab :label="$t('setting_role')">
          <role></role>
        </vs-tab>

      </vs-tabs>
    </div>

  </vx-card>
</template>

<script>
import moduleDataList from "@/store/data-list/moduleDataList.js";
import Role from '@/views/settings/_Role.vue';
import User from '@/views/settings/_User.vue';
export default {
  components: {
    Role,
    User
  },
  data() {
    return {
      // popupActive: false,
      selected: [],
      // products: [],
      itemsPerPage: 4,
      isMounted: false,

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},

    }
  },
  computed: {

  },
  methods: {

    toggleDataSidebar(val = false) {
      this.addNewDataSidebar = val
    },

  },
  created() {

  },
  mounted() {
    this.isMounted = true;
  }
}
</script>