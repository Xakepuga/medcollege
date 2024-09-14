import addFacultyBlock from './custom/personal-files/addFacultyBlock';
import avgCalculator from './custom/personal-files/avgCalculator';
import capsLockDetector from './custom/capsLockDetector';
import changeEnrollmentStatus from './custom/lists/changeEnrollmentStatus';
import checkboxHandler from './custom/personal-files/checkboxHandler';
import hideTrashBasketIcon from './custom/personal-files/hideTrashBasketIcon';
import {clickHandler} from './custom/personal-files/removeFacultyBlock';
import removeSessionMessage from './custom/removeSessionMessage';
import resetForm from './custom/personal-files/resetForm';
import fieldsHandlerDuringView from './custom/fieldsHandlerDuringView';
import removeCategoryItem from "./custom/removeFuncs/removeCategoryItem";
import removePersonalFile from "./custom/removeFuncs/removePersonalFile";
import removeUser from "./custom/removeFuncs/removeUser";
import toggleTableRowColor from "./custom/lists/toggleTableRowColor";
import checkboxHandlerFlag from './custom/personal-files/checkboxHandlerFlag';
import {removeFacultyBlock} from './custom/personal-files/removeFacultyBlock';
import backTopButton from './custom/backTopButton';
import downloadReport from "./custom/reports/downloadReport";

export const CONFIG = {

    '/': [
        backTopButton,
    ],

    '/personal-files/create-personal-file': [
        addFacultyBlock,
        avgCalculator,
        capsLockDetector,
        checkboxHandler,
        hideTrashBasketIcon,
        clickHandler,
        removeSessionMessage,
        resetForm,
        checkboxHandlerFlag,
        removeFacultyBlock,
    ],

    'personal-files/manage/personal-file/edit': [
        addFacultyBlock,
        avgCalculator,
        capsLockDetector,
        checkboxHandler,
        hideTrashBasketIcon,
        clickHandler,
        removePersonalFile,
        removeSessionMessage,
        checkboxHandlerFlag,
        removeFacultyBlock,
    ],

    'personal-files/manage/personal-file/view': [
        removePersonalFile,
        removeSessionMessage,
        fieldsHandlerDuringView,
        hideTrashBasketIcon,
    ],

    'personal-files/manage/personal-file/search': [
        removePersonalFile,
        removeSessionMessage,
    ],

    'students-lists': [
        removePersonalFile,
        removeSessionMessage,
    ],

    'students-lists/manage/enrollment/search': [
        changeEnrollmentStatus,
        toggleTableRowColor,
    ],

    'reporting/application-statistics': [
        removeSessionMessage,
    ],

    'reporting/universal-report': [
        removeSessionMessage,
    ],

    'reporting/universal-report/generate-report': [
        downloadReport,
    ],

    'admin/manage/users': [
        capsLockDetector,
        removeSessionMessage,
        removeUser,
    ],

    '/admin/manage/users/user/profile/view': [
        fieldsHandlerDuringView,
    ],

    'admin/manage/categories/category': [
        removeCategoryItem,
        removeSessionMessage,
    ],
};
