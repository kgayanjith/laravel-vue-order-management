<template>
  <AppLayout>
    <Link class="btn btn-primary py-1 px-5" :href="route('sales.create')">Add New</Link>
    <div class="table-responsive mt-3">
      <table class="table" id="salesTable">
        <thead class="">
          <tr class="">
            <th class="fw-bold" scope="col">Sale ID</th>
            <th class="fw-bold" scope="col">Sale Date</th>
            <th class="fw-bold" scope="col">Customer Name</th>
            <th class="fw-bold" scope="col">Product</th>
            <th class="fw-bold" scope="col">Quantity</th>
            <th class="fw-bold" scope="col">Price</th>
            <th class="fw-bold" scope="col">Tax</th>
            <th class="fw-bold" scope="col">Net Price</th>
            <th class="fw-bold" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sale in sales" :key="sale.id" @dblclick="openSale(sale.id)" style="cursor: pointer;">
            <td>{{ sale.id }}</td>
            <td>{{ sale.invoiceDate }}</td>
            <td>{{ sale.customer.name }}</td>
            <td>{{ sale.items[0].product.name }}</td>
            <td>{{ sale.items[0].quantity }}</td>
            <td>{{ Number(sale.items[0].excl_amount).toFixed(2) }}</td>
            <td>{{ sale.items[0].tax_rate }}%</td>
             <td>{{ Number(sale.items[0].incl_amount).toFixed(2) }}</td>
            <td>
              <Link class="btn btn-danger py-0 "><i class="fa-solid fa-xmark me-1"></i> Delete</Link>
            </td>
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
    sales: Array
  },
  mounted() {
    $(document).ready(function () {
      $('#salesTable').DataTable();
    });
  },
  methods: {
    openSale(id) {
      // console.log(id);
      this.$inertia.visit(route('sales.edit', id));
    }
  }
}
</script>

<style></style>