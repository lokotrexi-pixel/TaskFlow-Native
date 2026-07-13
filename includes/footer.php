<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/lucide@latest"></script>

<script>

lucide.createIcons();


function confirmDelete(url){

    Swal.fire({

        title: 'Hapus Data?',

        text: 'Data yang sudah dihapus tidak dapat dikembalikan.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonText: 'Ya, Hapus',

        cancelButtonText: 'Batal',

        background: '#0f172a',

        color: '#ffffff'

    }).then((result)=>{


        if(result.isConfirmed){

            window.location.href = url;

        }


    });


}


</script>