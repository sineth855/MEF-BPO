<!-- =========================================================================================
    File Name: CardBasic.vue
    Description: Basic Cards
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="demo-basic-card">
        <div class="vx-row">
            
            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">របាយការណ៍តាមកម្មវិធី</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 default medium mr-2 shadow-lg" type="gradient" @click="viewReportProgram()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4 default medium" type="border" color="#30c974" @click="viewReportProgram()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">របាយការណ៍គម្រោងវិនិយោគ(PIP)</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" @click="viewReportPIP()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4" type="border" color="#30c974" @click="viewReportPIP()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">របាយការណ៍ផែនការថវិកា(BSP)</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" @click="viewReportBSP()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4" type="border" color="#30c974" @click="viewReportBSP()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">របាយការណ៍គម្រោងថវិកាប្រចាំឆ្នាំ(PB)</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" @click="viewReportPB()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4" type="border" color="#30c974" @click="viewReportPB()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">របាយការណ៍កម្មវិធីចំណូល/ចំណាយ ប្រចាំត្រីមាស/ឆ្នាំ</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" @click="viewReportQuarterly()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4" type="border" color="#30c974" @click="viewReportQuarterly()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">លទ្ធផលអនុវត្តចំណូល</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 default mr-2 shadow-lg" type="gradient" @click="viewReportIncome()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4 default" type="border" color="#30c974" @click="viewReportIncome()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
                <vx-card>
                    <h5 class="mb-2">របាយការណ៍ចលនាតណទាន</h5>
                    <div class="flex justify-between flex-wrap">
                        <vs-button class="mt-4 default mr-2 shadow-lg" type="gradient" @click="viewReportCreditMovement()" color="#31ca75" gradient-color-secondary="#31ca75">{{$t("Download")}}</vs-button>
                        <vs-button class="mt-4 default" type="border" color="#30c974" @click="viewReportCreditMovement()">{{$t("View")}}</vs-button>
                    </div>
                </vx-card>
            </div>


        </div>

    </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import { videoPlayer }     from 'vue-video-player'
import VxTimeline          from "@/components/timeline/VxTimeline.vue"
import 'video.js/dist/video-js.css'


export default{
    data() {
        return {
            // card 1
            card_1: {},
            card_2: {},
            card_3: {},
            card_4: {},
            card_5: {},
            card_6: {},
            card_7: {},
            card_8: {},

            chatLog: [],
            chatMsgInput: '',

            card_9: {},

            timelineData: [
              {
                color : "primary",
                icon  : "PlusIcon",
                title : "New Task Added",
                desc  : "Bonbon macaroon jelly beans gummi bears jelly lollipop apple",
                time  : "25 Days Ago"
              },
              {
                color : "warning",
                icon  : "AlertCircleIcon",
                title : "Task Update Found",
                desc  : "Cupcake gummi bears soufflé caramels candy",
                time  : "15 Days Ago"
              },
              {
                color : "success",
                icon  : "CheckIcon",
                title : "Task Finished",
                desc  : "Candy ice cream cake. Halvah gummi bears",
                time  : "20 mins ago"
              }
            ],

            name  : '',
            email : '',
            msg   : '',

            playerOptions: {},
            settings: { // perfectscrollbar settings
                maxScrollbarLength: 60,
                wheelSpeed: .60,
            },
        }
    },
    components: {
        VuePerfectScrollbar,
        videoPlayer,
        VxTimeline
    },
    methods: {
        viewReportProgram(){
            this.$router.push('/report/program').catch(() => {});
        },
        viewReportPIP(){
            this.$router.push('/report/pip').catch(() => {});
        },
        viewReportPB(){
            this.$router.push('/report/pb').catch(() => {});
        },
        viewReportBSP(){
            this.$router.push('/report/bsp').catch(() => {});
        },
        viewReportQuarterly(){
            this.$router.push('/report/quarterly').catch(() => {});
        },
        viewReportIncome(){
            this.$router.push('/report/income').catch(() => {});
        },
        viewReportCreditMovement(){
            this.$router.push('/report/credit-movement').catch(() => {});
        },
    },
    mounted() {
        this.$refs.chatLogPS.$el.scrollTop = this.$refs.chatLog.scrollHeight;
    },
    created() {
      // Card 1
      this.$http.get("/api/users/pixinvent/product/1")
        .then((response) => { this.card_1 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 2
      this.$http.get("/api/users/pixinvent/product/sales/1")
        .then((response) => { this.card_2 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 3
      this.$http.get("/api/users/pixinvent/product/goals/1")
        .then((response) => { this.card_3 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 4
      this.$http.get("/api/users/89")
        .then((response) => { this.card_4 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 5
      this.$http.get("/api/users/58")
        .then((response) => { this.card_5 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 6
      this.$http.get("/api/users/16")
        .then((response) => { this.card_6 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 7
      this.$http.get("/api/place/18")
        .then((response) => { this.card_7 = response.data })
        .catch((error)   => { console.log(error) })

      // Card 8
      this.$http.get("/api/place/76/weather")
        .then((response) => { this.card_8 = response.data })
        .catch((error)   => { console.log(error) })

      // Chat Log
      this.$http.get("/api/chat/demo-1/log")
        .then((response) => { this.chatLog = response.data })
        .catch((error)   => { console.log(error) })

      // Card 9
      this.$http.get("/api/item/12/review")
        .then((response) => { this.card_9 = response.data })
        .catch((error)   => { console.log(error) })

      // Player Options
      this.$http.get("/api/card/card-basic/player-option")
        .then((response) => { this.playerOptions = response.data })
        .catch((error)   => { console.log(error) })
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
