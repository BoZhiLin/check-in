<template>
  <div>
    <div tabindex="-1" class="b-sidebar-outer">
      <div
        id="sidebar-variant"
        tabindex="-1"
        role="dialog"
        aria-modal="false"
        aria-labelledby="sidebar-variant___title__"
        class="b-sidebar shadow bg-dark text-light"
      >
        <header class="b-sidebar-header">
          <strong id="sidebar-variant___title__">後台管理</strong>
        </header>
        <div class="b-sidebar-body">
          <div class="px-3 py-2">
            <nav class="mb-3 items">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link active">Active</a>
                </li>
                <li class="nav-item">
                  <a href="#link-1" target="_self" class="nav-link">Link</a>
                </li>
                <li class="nav-item">
                  <a href="#link-2" target="_self" class="nav-link"
                    >Another Link</a
                  >
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.items {
  margin-top: 50px;
  font-size: 18px;
}
</style>
