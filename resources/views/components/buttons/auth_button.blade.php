<div>
  <button
    type="submit"
    class="form_button"
  >
   {{ request()->path() === "auth/login" ? "login" : "submit" }}
  </button>
</div>