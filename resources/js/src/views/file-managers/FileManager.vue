<template>
  <div id="upload-demo">
    <!-- <upload-default></upload-default> -->
    <!-- <upload-multiple></upload-multiple> -->
    <div id="tabs-demo">
      <vx-card title="បណ្ណាល័យឯកសារ">
        <!-- <upload-automatic></upload-automatic> -->
        <div class="vx-row">
          <!-- Grid Image -->
          <div class="vx-col w-full sm:w-1/2 lg:w-1/4 mb-base">
            <vx-card>
              <div slot="no-body">
                <img :src="card_1.img" alt="content-img" class="responsive card-img-top">
              </div>
              <h5 class="mb-2">{{ card_1.title }}</h5>
              <p class="text-grey">{{ card_1.subtitle }}</p>
              <div class="flex justify-between flex-wrap">
                <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" color="#7367F0"
                  gradient-color-secondary="#CE9FFC">Download</vs-button>
                <!-- <vs-button class="mt-4" type="border" color="#b9b9b9">View All</vs-button> -->
              </div>
            </vx-card>
          </div>

        </div>
      </vx-card>
    </div>

    <v-tree ref='tree' :canDeleteRoot="true" :data='treeData' :draggable='true' :tpl='tpl' :halfcheck='true'
      :multiple="true" />

  </div>
</template>

<script>
import UploadDefault from './UploadDefault.vue'
import UploadMultiple from './UploadMultiple.vue'
import UploadAutomatic from './UploadAutomatic.vue'

import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import { videoPlayer } from 'vue-video-player'
import VxTimeline from "@/components/timeline/VxTimeline.vue"
import { VTree, VSelectTree } from 'vue-tree-halower'
import 'video.js/dist/video-js.css'

export default {
  data() {
    return {
      treeData: [{
        title: 'node1',
        expanded: true,
        children: [{
          title: 'node 1-1',
          expanded: true,
          children: [{
            title: 'node 1-1-1'
          }, {
            title: 'node 1-1-2'
          }, {
            title: 'node 1-1-3'
          }]
        }, {
          title: 'node 1-2',
          children: [{
            title: "<span style='color: red'>node 1-2-1</span>"
          }, {
            title: "<span style='color: red'>node 1-2-2</span>"
          }]
        }]
      }],
      card_1: {
        img: "",
        title: "Test",
        subtitle: "Description"
      },
      chatLog: [],
      chatMsgInput: '',

      card_9: {},

      timelineData: [
        {
          color: "primary",
          icon: "PlusIcon",
          title: "New Task Added",
          desc: "Bonbon macaroon jelly beans gummi bears jelly lollipop apple",
          time: "25 Days Ago"
        },
        {
          color: "warning",
          icon: "AlertCircleIcon",
          title: "Task Update Found",
          desc: "Cupcake gummi bears soufflé caramels candy",
          time: "15 Days Ago"
        },
        {
          color: "success",
          icon: "CheckIcon",
          title: "Task Finished",
          desc: "Candy ice cream cake. Halvah gummi bears",
          time: "20 mins ago"
        }
      ],

      name: '',
      email: '',
      msg: '',

      playerOptions: {},
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60,
      },
    }
  },
  components: {
    UploadDefault,
    UploadMultiple,
    UploadAutomatic,
    VuePerfectScrollbar,
    videoPlayer,
    VxTimeline,
    VTree,
    VSelectTree
  },
  mounted() {
    this.$refs.chatLogPS.$el.scrollTop = this.$refs.chatLog.scrollHeight;
  },
  created() {

  }
}
</script>

<style lang="scss">
#demo-basic-card {
  .overlay-card {
    .vx-card__collapsible-content {
      max-height: 485px;
    }
  }

  .chat-card-log {
    height: 360px;

    .chat-sent-msg {
      background-color: #f2f4f7 !important;
    }
  }

  .card-video {
    .video-js {
      height: 370px;
    }
  }
}
</style>
