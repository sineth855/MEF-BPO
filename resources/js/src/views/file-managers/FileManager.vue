<!-- =========================================================================================
    File Name: Upload.vue
    Description: Upload - Imports all page portions
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div id="upload-demo">
        <!-- <upload-default></upload-default> -->
        <!-- <upload-multiple></upload-multiple> -->
        
      <div id="tabs-demo">
        <vx-card title="បណ្ណាល័យឯកសារ">
          <upload-automatic></upload-automatic>
          <div class="mt-12">
              <vs-tabs alignment="fixed" :position="isSmallerScreen ? 'top' : 'left'">
                  <vs-tab label="រូបភាព">
                    <div>
                      <vs-navbar :type="type" v-model="activeItem" class="p-2">
                        <div slot="title">
                          <vs-navbar-title>
                            <span>ប្រភេទឯកសារ {{type}}</span>
                          </vs-navbar-title>
                        </div>

                        <vs-navbar-item index="0">
                          <a href="#">រូបភាព</a>
                        </vs-navbar-item>

                        <vs-navbar-item index="1">
                          <a href="#">ឯកសារ</a>
                        </vs-navbar-item>

                        <vs-navbar-item index="2">
                          <a href="#">វីដេអូ</a>
                        </vs-navbar-item>
                      </vs-navbar>
                    </div>
                  </vs-tab>
                  <vs-tab label="ឯកសារ">
                      <div>tes3</div>
                  </vs-tab>
                  <vs-tab label="វីដេអូ">
                      <div>te5</div>
                  </vs-tab>
              </vs-tabs>
          </div>
        </vx-card>
      </div>
    </div>
</template>

<script>
import UploadDefault from './UploadDefault.vue'
import UploadMultiple from './UploadMultiple.vue'
import UploadAutomatic from './UploadAutomatic.vue'

export default{
    components: {
        UploadDefault,
        UploadMultiple,
        UploadAutomatic,
    }
}
</script>
