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

      <vs-table :data="users">

          <template slot="thead" style="border:1px solid #000">
              <vs-th>ជំពូក</vs-th>
              <vs-th>គណនី</vs-th>
              <vs-th>អនុគណនី</vs-th>
              <vs-th>ចំណាត់ថ្នាក់ចំណូល</vs-th>

              <vs-th colspan="3">
                សរុបទាំងពន្ធដាថ្នាក់ក្រោមជាតិ
                <!-- <small>សរុបរួម+ពន្ធដាថ្នាក់ក្រោមជាតិ</small> -->
              </vs-th>

              <vs-th colspan="3" style="text-align: center;">សរុបរួម</vs-th>
          </template>

          <template  style="border:1px solid #000">
              
              <vs-tr :state="'Warning'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>សរុបរួមចំណូល(ក+ខ)</vs-td>

                <vs-td>ច្បា់ហិរញ្ញវត្ថុ</vs-td>
                <vs-td>អនុវត្ត</vs-td>
                <vs-td>អនុ/ច្បាប់</vs-td>

                <vs-td>ច្បា់ហិរញ្ញវត្ថុ</vs-td>
                <vs-td>អនុវត្ត</vs-td>
                <vs-td>អនុ/ច្បាប់</vs-td>
              </vs-tr>

              <vs-tr :state="'Success'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ចំណូលសារពើពន្ធក្នុងស្រុក</vs-td>

                <vs-td>1</vs-td>
                <vs-td>2</vs-td>
                <vs-td>3</vs-td>

                <vs-td>187,283</vs-td>
                <vs-td>187,283</vs-td>
                <vs-td>187,283</vs-td>
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
