<template>
  <div id="tabs-demo">
    <!-- <vs-tabs :position="isSmallerScreen ? 'top' : 'left'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">
      <vs-tab icon-pack="feather" icon="icon-bell" :label="!isSmallerScreen ? 'សិទ្ធ និងអ្នកប្រើប្រាស់' : ''">
        <div class="tab-text md:ml-12 md:mt-0 mt-12 ml-0">
          test
        </div>
      </vs-tab>
    </vs-tabs> -->
    <vx-card title="File Manager">
      <div class="mt-12">
          <vs-tabs alignment="fixed" :position="isSmallerScreen ? 'top' : 'left'">
              <vs-tab label="Home">
                <div>
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
              </vs-tab>
              <vs-tab label="Documents">
                  <div>te2</div>
              </vs-tab>
              <vs-tab label="Contributors">
                  <div>tes3</div>
              </vs-tab>
              <vs-tab label="Ecosystem">
                  <div>te5</div>
              </vs-tab>
          </vs-tabs>
      </div>
    </vx-card>
    
  </div>
</template>

<script>
// import FileManager from "./FileManager.vue"

export default {
  components: {
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
