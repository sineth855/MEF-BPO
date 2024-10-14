<template>
    <div class="demo-alignment">
        <vs-popup classContent="popup-example" :title="title"
            :active.sync="showModalForm">
            <form name="file">
                <input type="file" name="file" @change="selectedFile($event)"/>
                <input type="button" value="Upload" @click="initUploadFile()"/>
            </form>
        </vs-popup>
    </div>
</template>

<script>
import axios from "@/axios.js"
import { ref } from 'vue';
import Vue from "vue";
import apiConfig from "@/apiConfig.js"

export default {
    components: {
        
    },
    props: {
        // data: {
        //     required: true,
        // }
    },
    data() {
        return {
            title: "Upload File",
            showModalForm: false,
            dataInfo: {},
            dataIndicators: [
                {
                    id: "23",
                    code: "12-",
                    indicator_name: "ឈ្មោះសូចនាករ",
                }
            ],
            file: null
        }
    },
    methods: {
        initImport(){
            this.showModalForm = true;
        },
        // To show popup form when create new data
        // openNewForm(data) {
        //     this.dataInfo = {};
        //     this.showModalForm = true;
        //     this.$refs.refModalForm.showNewForm(data);
        // },
        // openNewFormByParent(obj) {
        //     this.dataInfo = {};
        //     this.showModalForm = true;
        //     this.$refs.refModalForm.showNewFormByParent(obj);
        // },
        // initForm(data) {
        //     this.showModalForm = true;
        //     this.dataInfo = data;
        //     this.$refs.refModalForm.showDataForm(data);
        //     // this.$refs.refInitRequest.showRequestData(data);
        // },
        // initTableData(flag) {
        //     console.log("by pass data ====", this.parentDataInfo);
        //     let _search_params = {
        //         dataInfo: this.parentDataInfo
        //     }
        //     this.$emit('clicked', _search_params);
        //     if(flag==""){
        //         this.showModalForm = false;
        //     }
        // }
        selectedFile(event) {
  	        console.log(event);
  	        this.file = event.target.files[0];
  	    },
        initUploadFile(){
            let formData = new FormData();
            formData.append('file', this.file);
            for(var pair of formData.entries()) {
                console.log(pair[0]+ ', '+ pair[1]);
            }

            console.log('uploadTodos', formData);
            return new Promise((resolve, reject) => {
                axios.post("/api/v1/upload_unit", formData)
                    .then((response) => {
                        if (response.data.message) {
                            this.$vs.notify({
                                title: 'Message',
                                text: response.data.message,
                                iconPack: 'feather',
                                icon: 'icon-check-circle',
                                color: 'primary',
                                position: 'top-right'
                            })
                        } else {
                            this.$vs.notify({
                                title: 'Message',
                                text: response.data.message,
                                iconPack: 'feather',
                                icon: 'icon-check-circle',
                                color: 'danger',
                                position: 'top-right'
                            })
                            this.$vs.loading.close();
                        }
                    }).catch((error) => {
                        reject(error)
                        this.$vs.notify({
                            title: 'Message',
                            text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
                            iconPack: 'feather',
                            icon: 'icon-check-circle',
                            color: 'danger',
                            position: 'top-right'
                        })
                        this.$vs.loading.close();
                    })
            })
            // this.$store.dispatch('uploadTodos', formData);
        }
    },
    created() {
        // console.log("check data form objects", this.data);
    }
}
</script>