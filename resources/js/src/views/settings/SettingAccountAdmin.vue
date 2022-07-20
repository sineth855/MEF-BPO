<template>
  <vx-card >
    <div class="mt-0">
      <vs-navbar :type="type" v-model="activeItem" class="p-2">
        <!-- <div slot="title">
          <vs-navbar-title>
            <span>Type {{type}}</span>
          </vs-navbar-title>
        </div> -->

        <vs-navbar-item index="0">
          <a href="#">{{ $t("Department") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="1">
          <a href="#">{{ $t("Sector") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="2">
          <a href="#">{{ $t("Duty") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="3">
          <a href="#">{{ $t("Entity") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="4">
          <a href="#">{{ $t("Bank") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="5">
          <a href="#">{{ $t("Position") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="6">
          <a href="#">{{ $t("Title") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="7">
          <a href="#">{{ $t("Currency") }}</a>
        </vs-navbar-item>

        <vs-navbar-item index="8">
          <a href="#">{{ $t("LetterType") }}</a>
        </vs-navbar-item>
      </vs-navbar>
    </div>
    <div class="mt-2">
        <department-list/>
    </div>

    <!-- Save & Reset Button -->
    <!-- <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2" @click="saveGeneral()">រក្សាទុក</vs-button>
    </div> -->
  </vx-card>
</template>

<script>
import vSelect from 'vue-select'
import { Validator } from 'vee-validate';
import axios from "@/axios.js"
import DepartmentList from "../setup/department/DepartmentList.vue"
const dict = {
    custom: {
        title: {
          required: 'សំជ្រើសរើសងារ',
          alpha: "First name may only contain alphabetic characters"
        }

    }
};
Validator.localize('en', dict);
export default {
  components: {
    'v-select': vSelect,
    DepartmentList
  },
  data() {
    return {
      activeItem: 0,
        type: 'gradient',
      noImage: require("@assets/images/no-account.png")
    }
  },
  created(){
    this.$vs.loading();
    setTimeout(() => {
      this.$vs.loading.close()
    }, 2000);
  },
  methods: {
    letterTypeList() {
      return [
      'លិខិតផ្ទៃក្នុង',
      'លិខិតចេញ',
      'លិខិតចូល'
      ]
    },
    saveGeneral(){
      this.$validator.validateAll().then(result => {
        if(result){
          let _data = {
            name: this.name,
            latin: this.latin,
            username: this.username,
            email: this.email,
            title: this.title.label ? this.title.label : this.title,
            position: this.position.label ? this.position.label : this.position,
            role_id: this.role.id ? this.role.id : this.role,
            department: this.department.label ? this.department.label : this.department,
            entity: this.entity.label ? this.entity.label : this.entity,
            username: this.username,
            telephone_1: this.telephone_1,
            telephone_2: this.telephone_2,
            password: this.password
          }
          if(this.$route.params.userId){
            let _userId = this.$route.params.userId;
            return new Promise((resolve, reject) => {
                axios.put("/api/v1/user/" + _userId, _data)
                    .then((response) => {
                    this.$vs.notify({
                      title: 'Message',
                      text: response.data.message,
                      iconPack: 'feather',
                      icon: 'icon-check-circle',
                      color: 'primary'
                    })
                    this.$router.push('/user/list').catch(() => {})
                }).catch((error) => { 
                  reject(error)
                  this.$vs.notify({
                    title: 'Message',
                    text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
                    iconPack: 'feather',
                    icon: 'icon-check-circle',
                    color: 'danger'
                  })
                })
            })
          }else{
            return new Promise((resolve, reject) => {
                axios.post("/api/auth/signup", _data)
                    .then((response) => {
                      console.log("message", response);
                    this.$vs.notify({
                      title: 'Message',
                      text: response.data.message,
                      iconPack: 'feather',
                      icon: 'icon-check-circle',
                      color: 'primary'
                    })
                    this.$router.push('/user/list').catch(() => {})
                }).catch((error) => { 
                  reject(error)
                  this.$vs.notify({
                    title: 'Message',
                    text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
                    iconPack: 'feather',
                    icon: 'icon-check-circle',
                    color: 'danger'
                  })
                })
            })
          }
        }
      });
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    },
  }
}
</script>
