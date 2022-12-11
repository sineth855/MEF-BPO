<template>
        <div class="demo-alignment">
            <vs-popup classContent="popup-example" title="បំពេញព័ត៌មានខាងក្រោម" :active.sync="showModalForm">
                <d-form @clickForm="initTableData" :data="data" :dataInfo="dataInfo" :formAttributes="formAttributes" :api="api" :rowDisplay="rowDisplay"></d-form>
            </vs-popup>
        </div>
</template>

<script>
import apiConfig from "@/apiConfig.js"
import DForm from '@/views/form-builder/DForm.vue'

export default {
    props: {
        data: {
            required: true,
        },
    },
  components: { DForm },
      data() {
        return {
            showModalForm: false,
            rowDisplay: "1grid", //1grid, 2grid, 3grid, 4grid
            api: apiConfig._apiObjective,
            formAttributes: [
                {
                    name: "name",
                    type: "text",
                    required: false
                },
                {
                    name: "name_kh",
                    type: "text",
                    required: true
                },
                // {
                //     name: "select",
                //     type: "select",
                //     required: false,
                //     data: this.data.titles
                // },
                {
                    name: "order_level",
                    type: "number",
                    required: false
                },
                // {
                //     name: "select",
                //     type: "select",
                //     required: false,
                //     data: this.data.order_status_choices
                // },
            ],
            dataInfo: {
                name: "data",
                name_kh: "dddd"
            }
        }
    },
    methods: {
        initForm(data) {
            this.showModalForm = true;
            this.dataInfo = data;
            console.log("form data", data);
        },
        initTableData() {
            this.$emit('clicked');
        }
    }
  }
</script>