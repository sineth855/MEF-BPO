<template>
    <div id="table-demo">
       <vx-card title="ពិដានថវិកាឆ្នាំ២០២២" code-toggler>
            <div class="flex flex-wrap-reverse items-center data-list-btn-container">

                <!-- ACTION - DROPDOWN -->
                <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-4 mb-4">

                    <div class="p-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
                    <span class="mr-2">{{$t("Action")}}</span>
                    <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                    </div>

                    <vs-dropdown-menu>

                    <vs-dropdown-item>
                        <span class="flex items-center">
                        <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                        <span>Delete</span>
                        </span>
                    </vs-dropdown-item>

                    <vs-dropdown-item>
                        <span class="flex items-center">
                        <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                        <span>Archive</span>
                        </span>
                    </vs-dropdown-item>

                    <vs-dropdown-item>
                        <span class="flex items-center">
                        <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                        <span>Print</span>
                        </span>
                    </vs-dropdown-item>

                    <vs-dropdown-item>
                        <span class="flex items-center">
                        <feather-icon icon="SaveIcon" svgClasses="h-4 w-4" class="mr-2" />
                        <span>Another Action</span>
                        </span>
                    </vs-dropdown-item>

                    </vs-dropdown-menu>
                </vs-dropdown>

                <!-- ADD NEW -->
                <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
                    <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                    <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
                </div>
            </div>
                
            <vs-table :data="data">

                <template slot="thead">
                    <vs-th>បរិយាយមុខសញ្ញា</vs-th>
                    <vs-th>ច្បាប់ឆ្នាំ២០២២</vs-th>
                    <vs-th>ចំណាយមិនប្រចាំ</vs-th>
                    <vs-th>ចំណាយប្រចាំ</vs-th>
                    <vs-th>ពិដានចំណាយចរន្ត</vs-th>
                    <vs-th>អាត្រាកំណើនប្រចាំឆ្នាំ</vs-th>
                </template>

                <template>
                    <vs-tr :state="'success'">
                        <vs-td colspan="6" >ផ្នែកទី១៖ ពិដានចំណាយចរន្ត ឆ្នាំ២០២៣-២០២៥ សរុបរួមក្រសួង (យោងលេខ ០៣ សរណន ចុះថ្ងៃទី៨ ខែមិថុនា ឆ្នាំ២០២២)</vs-td>
                    </vs-tr>
                    <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                        <vs-td>សរុបរួមក្រសួង</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                    </vs-tr>
                    
                    <vs-tr :state="'warning'">
                        <vs-td>I.រដ្ឋបាលកណ្តាល</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                    </vs-tr>

                        <vs-tr>
                        <vs-td>- បន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>
                        <vs-tr>
                        <vs-td>- ក្រៅបន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>

                    <vs-tr :state="'warning'">
                        <vs-td>II.មន្ទីរសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុរាជធានី-ខេត្ត</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                    </vs-tr>

                        <vs-tr>
                        <vs-td>- បន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>
                        <vs-tr>
                        <vs-td>- ក្រៅបន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>


                    <vs-tr :state="'warning'">
                        <vs-td>I.រដ្ឋបាលកណ្តាល</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                    </vs-tr>

                        <vs-tr>
                        <vs-td>- បន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>
                        <vs-tr>
                        <vs-td>- ក្រៅបន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>

                    <vs-tr :state="'warning'">
                        <vs-td>II.មន្ទីរសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុរាជធានី-ខេត្ត</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                    </vs-tr>

                        <vs-tr>
                        <vs-td>- បន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>
                        <vs-tr>
                        <vs-td>- ក្រៅបន្ទុកបុគ្គលិក</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>0.0</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        <vs-td>187,283</vs-td>
                        </vs-tr>
                </template>
            </vs-table>
        </vx-card>
    </div>
</template>

<script>

    export default{
        data() {
            return {
            data:[]
            }
        },
        components: {
        }
    }
</script>
