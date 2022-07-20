<!-- =========================================================================================
  File Name: UserEdit.vue
  Description: User Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-user-edit">

    <vs-alert color="danger" title="User Not Found" :active.sync="user_not_found">
      <span>User record with id: {{ $route.params.userId }} not found. </span>
      <span>
        <span>Check </span><router-link :to="{name:'page-user-list'}" class="text-inherit underline">All Users</router-link>
      </span>
    </vs-alert>

    <vx-card v-if="user_data">

      <div slot="no-body" class="tabs-container px-6 pt-6">

        <vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
          <vs-tab label="Account" icon-pack="feather" icon="icon-user">
            <div class="tab-text">
              <user-edit-tab-account class="mt-4" :data="user_data" />
            </div>
          </vs-tab>
          <vs-tab label="Information" icon-pack="feather" icon="icon-info">
            <div class="tab-text">
              <user-edit-tab-information class="mt-4" :data="user_data" />
            </div>
          </vs-tab>
          <vs-tab label="Social" icon-pack="feather" icon="icon-share-2">
            <div class="tab-text">
              <user-edit-tab-social class="mt-4" :data="user_data" />
            </div>
          </vs-tab>
        </vs-tabs>

      </div>

    </vx-card>
  </div>
</template>

<script>
import UserEditTabAccount     from "./UserEditTabAccount.vue"
import UserEditTabInformation from "./UserEditTabInformation.vue"
import UserEditTabSocial      from "./UserEditTabSocial.vue"

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

export default {
  components: {
    UserEditTabAccount,
    UserEditTabInformation,
    UserEditTabSocial,
  },
  data() {
    return {
      user_data: null,
      // user_data: {
      //   username: '',
      //   name: '',
      //   email: '',
      //   company: '',
      //   status:[
      //     {
      //       label: "Active",  value: "active"
      //     }
      //   ],
      //   role:[
      //     {
      //       label: "Admin",  value: "admin"
      //     }
      //   ]
      // },
      user_not_found: false,

      /*
        This property is created for fetching latest data from API when tab is changed

        Please check it's watcher
      */
      activeTab: 0,
    }
  },
  watch: {
    activeTab() {
      this.fetch_user_data(this.$route.params.userId)
    }
  },
  methods: {
    fetch_user_data(userId) {
      if(userId > 0){
        this.$store.dispatch("userManagement/fetchUser", userId)
          .then(res => { this.user_data = res.data })
          .catch(err => {
            if(err.response.status === 404) {
              this.user_not_found = true
              return
            }
            console.error(err) })
      }else{
        this.user_data = {
          "username": "",
          "avatar": require("@assets/images/no-image.png"),
          "email": "",
          "name": "",
          "dob": "",
          "gender": "",
          "country": "",
          "role": "",
          "status": "active",
          "is_verified": true,
          "department": "",
          "company": "",
          "mobile": "",
          "website": "",
          "languages_known": [],
          "contact_options": [],
          "location": {
            "add_line_1": "",
            "add_line_2": "",
            "post_code": "",
            "city": "",
            "state": "",
            "country": ""
          },
          "social_links": {
            "twitter": "",
            "facebook": "",
            "instagram": "",
            "github": "",
            "codepen": "",
            "slack": "",
          },
          "permissions": {
            "users": {
              "read": true,
              "write": false,
              "create": false,
              "delete": false
            },
            "posts": {
              "read": true,
              "write": true,
              "create": true,
              "delete": true
            },
            "comments": {
              "read": true,
              "write": false,
              "create": true,
              "delete": false
            },

          }
        }

        this.location = {
          avatar: "/images/avatar-s-3.jpg?7ed1da4ad8611b35f46c43992d08833d",
          company: "WinDon Technologies Pvt Ltd",
          contact_options: {
            "email": "test@test.com",
            "message": "message",
            "phone": "081397071"
          },
          country: "Bolivia",
          department: "sales",
          dob: "28 January 1998",
          email: "angelo@sashington.com",
          gender: "male",
          id: 268,
          is_verified: true,
          languages_known: Array(2),
          location: Object,
          mobile: "+65958951757",
          name: "Angelo Sashington",
          permissions: Object,
          role: "admin",
          social_links: Object,
          status: "active",
          username: "adoptionism744",
          website: "https://rowboat.com/insititious/Angelo"
        }
      }
    }
  },
  created() {
    // Register Module UserManagement Module
    if(!moduleUserManagement.isRegistered) {
      this.$store.registerModule('userManagement', moduleUserManagement)
      moduleUserManagement.isRegistered = true
    }
    this.fetch_user_data(this.$route.params.userId)
  }
}

</script>
