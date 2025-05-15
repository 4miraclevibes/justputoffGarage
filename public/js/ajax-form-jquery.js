function handleAjaxFormJQ(selector, { successMessage = '', reload = true, onSuccess = null } = {}) {
    $(document).on('submit', selector, function(e) {
      e.preventDefault();
      const form = this;
      const formData = new FormData(form);
      const url = $(form).attr('action');
      const method = $(form).find('input[name="_method"]').val() || 'POST';

      $.ajax({
        url: url,
        method: method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
          if (onSuccess && typeof onSuccess === 'function') {
            onSuccess(res);
          } else {
            Swal.fire('Sukses', successMessage, 'success');
            if (reload) location.reload();
          }
        },
        error: function(err) {
          console.error(err);
          Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
        }
      });
    });
  }