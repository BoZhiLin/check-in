<template>
  <div>
    <Layout>
      <div class="row d-flex justify-content-center">
        <h3>後台人員</h3>
      </div>

      <div class="divider"></div>

      <div class="row d-flex justify-content-center table-section">
        <b-table striped hover :fields="fields" :items="items" responsive="sm" class="table">
          <!-- A virtual column -->
          <template #cell(index)="data">
            {{ data.index + 1 }}
          </template>

          <!-- A custom formatted column -->
          <template #cell(name)="data">
            <b class="text-info">{{ data.value.last.toUpperCase() }}</b>, <b>{{ data.value.first }}</b>
          </template>

          <!-- A virtual composite column -->
          <template #cell(nameage)="data">
            {{ data.item.name.first }} is {{ data.item.age }} years old
          </template>

          <!-- Optional default data cell scoped slot -->
          <template #cell()="data">
            <i>{{ data.value }}</i>
          </template>
        </b-table>
      </div>
    </Layout>
  </div>
</template>

<script>
import Layout from "@/components/Layout";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      fields: [
          // A virtual column that doesn't exist in items
          'index',
          // A column that needs custom formatting
          { key: 'name', label: 'Full Name' },
          // A regular column
          'age',
          // A regular column
          'sex',
          // A virtual column made up from two fields
          { key: 'nameage', label: 'First name and age' }
        ],
        items: [
          { name: { first: 'John', last: 'Doe' }, sex: 'Male', age: 42 },
          { name: { first: 'Jane', last: 'Doe' }, sex: 'Female', age: 36 },
          { name: { first: 'Rubin', last: 'Kincade' }, sex: 'Male', age: 73 },
          { name: { first: 'Shirley', last: 'Partridge' }, sex: 'Female', age: 62 }
        ]
    }
  }
}
</script>

<style lang="scss" scoped>
h3 {
  font-weight: bold;
  margin-left: 5px;
  margin-top: 100px;
}

.divider {
  height: 100px;
}

.table-section {
  margin-left: 5px;
}

.table {
  width: 95%;
}
</style>