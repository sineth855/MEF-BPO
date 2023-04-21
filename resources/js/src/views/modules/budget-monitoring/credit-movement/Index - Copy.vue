<template>
    <vx-card title="ចុះលទ្ធផលអនុវត្តចំណូល" code-toggler>
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

         <div id="popup-demo">
          <popup-fullscreen></popup-fullscreen>
        </div>

      <vs-table :data="users" style="overflow: scroll">
          <template>
            
            <vs-tr style="background-color: rgb(183 255 215)">
              <vs-td>ជំពូក</vs-td>
              <vs-td>ឆ្នាំ</vs-td>
              <vs-td>អនុកម្មវិធី</vs-td>
              <vs-td>លេខប្រកាស</vs-td>
              <vs-td>កាលបរិច្ឆេទ</vs-td>
              <vs-td>ប្រភេទចលនាឥណទាន</vs-td>
              <vs-td>ប្រភេទចំណាយ</vs-td>
              <vs-td>អនុគណនី</vs-td>
              <vs-td>ចង្កោមសកម្មភាព</vs-td>
              <vs-td>កើន</vs-td>
              <vs-td>ថយ</vs-td>

              <vs-td>កើន</vs-td>
              <vs-td>ថយ</vs-td>

              <vs-td>ចលនា</vs-td>
              <vs-td>កូដ ESE</vs-td>
              <vs-td>លេខកូដ</vs-td>
              <vs-td>ចលនា</vs-td>

              <vs-td>ចលនា1119</vs-td>
              <vs-td>ប្រភេទចំណាយ</vs-td>
            </vs-tr>

            <vs-tr style="min-height: 20px; font-size: 11px;" :state="'Warning'">
              <vs-td>Chapter</vs-td>
              <vs-td>Year</vs-td>
              <vs-td>SubProgram</vs-td>
              <vs-td>#DOC</vs-td>
              <vs-td>Date</vs-td>
              <vs-td>Budget Movement</vs-td>
              <vs-td>Expense Type</vs-td>
              <vs-td>SubAccount</vs-td>
              <vs-td>ECACode</vs-td>
              <vs-td>Increase</vs-td>
              <vs-td>Decrease</vs-td>

              <vs-td>+</vs-td>
              <vs-td>-</vs-td>

              <vs-td>=</vs-td>
              <vs-td>Code ESE</vs-td>
              <vs-td>Entry Code</vs-td>
              <vs-td>Dif</vs-td>

              <vs-td>Dif_1119</vs-td>
              <vs-td>Expense Type</vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr>
              <vs-td>60</vs-td>
              <vs-td>2022</vs-td>
              <vs-td>104</vs-td>
              <vs-td>001 សហវ. អថ 3/6/2022</vs-td>
              <vs-td>វិចារណៈកម្មចំណាយ</vs-td>
              <vs-td></vs-td>
              <vs-td>60015</vs-td>
              <vs-td>1</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td>160015</vs-td>
              <vs-td></vs-td>
              <vs-td>0.00</vs-td>

              <vs-td>0.00</vs-td>
              <vs-td></vs-td>
            </vs-tr>

          </template>
      </vs-table>

    </vx-card>
</template>

<script>
export default {
    data() {
        return {
           
        }
    },
}
</script>

<style>
  th.th-width-300{
    min-width: 260px !important;
  }
  td.td-width-150{
    min-width: 150px !important;
  }
  table tr td, th{
    border: 1px solid #d7d7d7;
    font-size: 12px;
    min-width: 100px;
    text-align: center;
  }
  th{
    text-align: center !important;
    /* display: inline; */
  }
  th.rotate{
    transform: rotate(-90deg)
  }
.vs-table--thead th .vs-table-text {
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    display: inline !important;
}
</style>