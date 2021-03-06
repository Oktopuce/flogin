.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. _action:

Username
=========

    During the authentication process, **username** is a required brick.

    .. figure:: ../../../Images/login.png
        :class: with-shadow

        Login form view.

Validation Feedback
---------------------

    After credentials were submitted, system checks if provided **username** is valid.

    .. figure:: ../../../Images/login_field-user_unknown.png
        :class: with-shadow

        **username** does not exist.

    However, when user does exist, message is not there anymore.

    .. figure:: ../../../Images/login_field-user_exists.png
        :class: with-shadow

        **username** does exist.

Tweak a validation message
---------------------------

    * Validation text is stored under

        .. tip::

            :ts:`LLL:EXT:flogin/Resources/Private/Language/locallang.xlf:username.not_found`
