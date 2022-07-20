<template>
  <vx-card >
    <div class="mt-0">
      <vs-navbar :type="type" v-model="activeItem" class="p-2">
        <div slot="title">
          <vs-navbar-title>
            <span>Type {{type}}</span>
          </vs-navbar-title>
        </div>

        <vs-navbar-item index="0">
          <a href="#">Home</a>
        </vs-navbar-item>

        <vs-navbar-item index="1">
          <a href="#">News</a>
        </vs-navbar-item>

        <vs-navbar-item index="2">
          <a href="#">Update</a>
        </vs-navbar-item>
      </vs-navbar>
    </div>

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
        title: {
          required: 'សំជ្រើសរើសងារ',
          alpha: "First name may only contain alphabetic characters"
        },
        latin: {
          required: 'សុំបញ្ជូលឈ្មោះឡាតាំង',
          alpha: "First name may only contain alphabetic characters"
        },
        position: {
          required: 'សុំជ្រើសរើសមុខងារ',
          alpha: "First name may only contain alphabetic characters"
        },
        department: {
          required: 'សុំជ្រើសរើសផ្នែក',
          alpha: "First name may only contain alphabetic characters"
        },
        role: {
          required: 'សុំជ្រើសរើសតួនាទី',
          alpha: "First name may only contain alphabetic characters"
        },
        entity: {
          required: 'សុំជ្រើសរើសអង្គភាព',
          alpha: "First name may only contain alphabetic characters"
        },
        username: {
          required: 'សូមបំពេញឈ្មោះអ្នកប្រើប្រាស់',
          alpha: "First name may only contain alphabetic characters"
        },
        name: {
          required: 'សូមបំពេញឈ្មោះ',
          alpha: "First name may only contain alphabetic characters"
        },
        password: {
          required: 'សូមបំពេញលេខសម្ងាត់',
          alpha: "First name may only contain alphabetic characters"
        },
        confirmPassword: {
          required: 'សូមបញ្ជាក់លេខសម្ងាត់',
          alpha: "First name may only contain alphabetic characters"
        },

    }
};
Validator.localize('en', dict);
export default {
  components: {
    'v-select': vSelect
  },
  data() {
    return {
      title: "",
      position: "",
      role: "",
      latin: "",
      department: "",
      entity: "",
      username: "",
      telephone_1: "",
      telephone_2: "",
      name: "",
      email: "",
      company: "",
      password: "",
      confirmPassword: "",

      titles: [],
      entities: [],
      departments: [],
      positions: [],
      roles: [],
      noImage: require("@assets/images/no-account.png")
    }
  },
  created(){
    this.$vs.loading();
    setTimeout(() => {
      this.$vs.loading.close()
    }, 2000);
    this.getRole()
    this.getTitle()
    this.getEntity()
    this.getDepartment()
    this.getPosition()
    if(this.$route.params.userId){
      let _userId = this.$route.params.userId
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/user/" + _userId)
            .then((response) => {
            let _data = response.data.data
            this.title = _data.title
            this.role_id = _data.role_id
            this.position = _data.position
            this.duty = _data.duty
            this.latin = _data.latin
            this.department = _data.department
            this.entity = _data.entity
            this.username = _data.username
            this.telephone_1 = _data.telephone_1
            this.telephone_2 = _data.telephone_2
            this.name = _data.name
            this.email = _data.email
            this.company = _data.company
            this.password = _data.password
            this.role = this.roles.find(i => i.id == _data.role_id);
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
    letterTypeList() {
      return [
      'លិខិតផ្ទៃក្នុង',
      'លិខិតចេញ',
      'លិខិតចូល'
      ]
    },
    getTitle(){
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/title?offset=0&limit=100&sort=id&order=desc")
            .then((response) => {
            let titles = response["data"]["data"];
            for(let i = 0; i < titles.length; i++){
                const _data = {
                    id: titles[i]["id"],
                    label: titles[i]["name"]
                };
                this.titles.push(_data);
            }
        }).catch((error) => { reject(error) })
      })
    },
    getEntity(){
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/entity?offset=0&limit=100&sort=id&order=desc")
            .then((response) => {
            let entities = response["data"]["data"];
            for(let i = 0; i < entities.length; i++){
                const _data = {
                    id: entities[i]["id"],
                    label: entities[i]["name"]
                };
                this.entities.push(_data);
            }
        }).catch((error) => { reject(error) })
      })
    },
    getDepartment(){
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/department?offset=0&limit=100&sort=id&order=desc")
            .then((response) => {
            let departments = response["data"]["data"];
            for(let i = 0; i < departments.length; i++){
                const _data = {
                    id: departments[i]["id"],
                    label: departments[i]["name"]
                };
                this.departments.push(_data);
            }
        }).catch((error) => { reject(error) })
      })
    },
    getPosition(){
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/position?offset=0&limit=100&sort=id&order=desc")
            .then((response) => {
            let positions = response["data"]["data"];
            for(let i = 0; i < positions.length; i++){
                const _data = {
                    id: positions[i]["id"],
                    label: positions[i]["name"]
                };
                this.positions.push(_data);
            }
        }).catch((error) => { reject(error) })
      })
    },
    getRole(){
      return new Promise((resolve, reject) => {
        axios.get("/api/v1/role?offset=0&limit=100&sort=id&order=desc")
            .then((response) => {
            let roles = response["data"]["data"];
            for(let i = 0; i < roles.length; i++){
                const _data = {
                    id: roles[i]["id"],
                    label: roles[i]["name"]
                };
                this.roles.push(_data);
            }
        }).catch((error) => { reject(error) })
      })
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
