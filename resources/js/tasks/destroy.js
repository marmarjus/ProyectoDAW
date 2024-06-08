async function deleteTask(apiUrl, taskId, accessToken, userRole) {
    if (userRole === 'participant') {
        showToast('No tienes permisos para realizar esta acción.', 'linear-gradient(to right, #DB0202, #750000)');
        return;
    }

    try {
        const response = await fetch(`${apiUrl}/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${accessToken}`,
            },
        });

        if (response.status === 204) {
            showToast("Tarea eliminada con éxito", "linear-gradient(to right, #00b09b, #96c93d)");
        } else {
            const data = await response.json();
            throw new Error(data.error || 'Error al borrar.');
        }
    } catch (error) {
        console.error(error.message);
    }
}

async function getUserRole(apiUrl, accessToken) {
    try {
        const response = await fetch(`${apiUrl}/currentUser`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        });

        if (!response.ok) {
            throw new Error('Error al obtener la información del usuario.');
        }

        const data = await response.json();
        console.log(data.rol);
        return data.rol;
    } catch (error) {
        console.error(error.message);
        return null;
    }
}


function showConfirm(apiUrl, taskId, accessToken, userRole) {
    $.confirm({
        title: '¿Seguro que quieres borrar esta tarea?',
        content: 'La acción es irreversible.',
        type: 'red',
        boxWidth: '60%',
        useBootstrap: false,
        icon: 'fa fa-warning',
        closeIcon: true,
        closeIconClass: 'fa fa-close',
        animateFromElement: false,
        animation: 'scale',
        backgroundDismiss: false,
        backgroundDismissAnimation: 'shake',
        buttons: {
            confirm: {
                text: 'Confirmar',
                btnClass: 'btn-green',
                action: async function () {
                    await deleteTask(apiUrl, taskId, accessToken, userRole);
                }
            },
            cancel: {
                text: 'Cancelar',
                btnClass: 'btn-red',
                action: function () {

                }
            },
        }
    });
}

function showToast(message, background) {
    Toastify({
        text: message,
        duration: 1500,
        gravity: "top",
        position: "center",
        style: {
            background: background,
        },
        callback: function () {
            window.location.href = '/tasks';
        }
    }).showToast();
}

window.initializeDeleteTask = async function (apiUrl, taskId, accessToken) {
    const userRole = await getUserRole(apiUrl, accessToken);

    const deleteButton = document.getElementById('delete-task');
    deleteButton.addEventListener('click', function () {

        showConfirm(apiUrl, taskId, accessToken, userRole);

    });
};
