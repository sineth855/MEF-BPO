<template>
  <vx-card no-shadow>

    <div class="vx-row">
      <div class="vx-col md:w-1/2 w-full mt-5">
        <vs-input aria-disabled="true" label="អ្នកប្រើប្រាស់(Eg:+85581xxxxxx)" autocomplete="off" name="username" v-model="username" class="w-full" v-validate="'required'"/>
        <span class="text-danger">{{ errors.first('username') }}</span>
      </div>

      <div class="vx-col md:w-1/2 w-full mt-5">
        <vs-input type="password" label="លេខសម្ងាត់" autocomplete="off" name="password" v-model="password" class="w-full" v-validate="'required'"/>
        <span class="text-danger">{{ errors.first('password') }}</span>
      </div>

      <div class="vx-col md:w-1/2 w-full mt-5">
        <vs-input type="password" label="បញ្ជាក់លេខសម្ងាត់" autocomplete="off" name="confirm_password" v-model="confirm_password" class="w-full" v-validate="'required'"/>
        <span class="text-danger">{{ errors.first('confirm_password') }}</span>
      </div>
    </div>
    <!-- <vs-input class="w-full mb-base" label-placeholder="អ្នកប្រើប្រាស់" v-model="username" />
    <span class="text-danger">{{ errors.first('first_name') }}</span>
    <vs-input class="w-full mb-base" label-placeholder="លេខសម្ងាត់" v-model="password" />
    <vs-input class="w-full mb-base" label-placeholder="បញ្ជាក់លេខសម្ងាត់" v-model="confirm_password" /> -->

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2" @click="saveGeneral()">រក្សាទុក</vs-button>
      <!-- <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button> -->
    </div>
  </vx-card>
</template>

<script>
import vSelect from 'vue-select'
import { Validator } from 'vee-validate';
import axios from "@/axios.js"
const dict = {
  custom: {
    username: {
      required: 'សំុបញ្ជូលឈ្មោះអ្នកប្រើប្រព័ន្ធ',
      alpha: "First name may only contain alphabetic characters"
    },
    new_password: {
      required: 'សំុបញ្ជូលលេខសម្ងាត់',
      alpha: "First name may only contain alphabetic characters"
    },
    confirm_password: {
      required: 'សំុបញ្ជាក់លេខសម្ងាត់',
      alpha: "First name may only contain alphabetic characters"
    },
  }
};
Validator.localize('en', dict);
export default {
  data() {
    return {
      username: "",
      password: "",
      confirm_password: "",
      user_id: ""
    }
  },
  created(){
    if(this.$route.params.id){
      let _id = this.$route.params.id
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/incentive_officer/" + _id)
            .then((response) => {
            let _data = response.data
            if(_data.userInfo!=null){
              this.user_id = _data.data.user_id
              this.username = _data.userInfo.username
            }
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
  },
  methods: {
    saveGeneral(){
      let _id = this.$route.params.id;
      this.$validator.validateAll().then(result => {
        if(result){
          let _data = {
            id: _id,
            username: this.username,
            password: this.password,
            user_id: this.user_id
          }
          if(this.$route.params.id){
            return new Promise((resolve, reject) => {
                axios.post("/api/v1/update_officer_user", _data)
                    .then((response) => {
                    this.$vs.notify({
                      title: 'Message',
                      text: response.data.message,
                      iconPack: 'feather',
                      icon: 'icon-check-circle',
                      color: 'primary'
                    })
                    this.$router.push('/officer/list').catch(() => {})
                }).catch((error) => { 
                  reject(error)
                  this.$vs.notify({
                    title: 'Message',
                    text: "មិនអាចធ្វើបច្ចុប្បន្នភាពបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
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
