<template>
  <AppLayout>
    <Link class="btn btn-primary py-1 px-5" :href="route('sales.create')">Add New</Link>
    <div class="table-responsive mt-3">
      <table class="table" id="salesTable">
        <thead class="">
          <tr class="text-center">
            <th class="fw-bold" scope="col">ID</th>
            <th class="fw-bold" scope="col">Product Name</th>
            <th class="fw-bold" scope="col">Product Description</th>
            <th class="fw-bold" scope="col">Price</th>
            <th class="fw-bold" scope="col">Status</th>
            <th class="fw-bold" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr @click="openSale(id)">
            <td>1</td>
            <td>dsdsds</td>
            <td>dsdsds</td>
            <td>dsdsds</td>
            <td>dsdsds</td>
            <td>dsdsds</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


export default {
  components: {
    AppLayout,
    Link
  },
  props: {
    // products: Array
  },
  mounted() {
    $(document).ready(function () {
      $('#salesTable').DataTable();
    });
  },
  methods: {
    openSale(id) {
      console.log(id);
    }
  }
}
</script>

<style></style>