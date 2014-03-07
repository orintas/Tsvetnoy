<?php
set_include_path('/home/tfoot/protsvetnoy.com/docs/core/components/moysklad');
require_once('service.moysklad.php');
require_once('utils.moysklad.php');
require_once('config.moysklad.php');

$service = new MoySkladService();
$entities = $service->getEntities();
$result = array();
foreach ($entities->attributes() as $name => $value) {
	$result[$name] = (string)$value;
}
$i = 0;
$resultEntities = array();
foreach ($entities as $entity) {
    switch((string)$entity['entityMetadataUuid']) {
        case MoySkladConfig::SIZES_METADATA_UUID:
            $resultEntities[(string)$entity->uuid] = array('value' => (string)$entity['name'], 'name' => 'Размер');
            break;
    }
}
//array_multisort($codes, SORT_ASC, $resultGoods);
$result['entity'] = $resultEntities;
return json_encode($result);
/* Example XML
This XML file does not appear to have any style information associated with it. The document tree is shown below.
<collection total="67" start="0" count="1000">
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Полиптих 50x200" updated="2013-07-10T13:20:55.660+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>064162f2-e942-11e2-140b-7054d21a8d1e</uuid>
<code/>
<externalcode>QdcmrGWMjg2UcuMcf8j3_3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Триптих 50x80" updated="2013-10-16T12:44:05.250+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>0e9b009b-363f-11e3-3761-7054d21a8d1e</uuid>
<code/>
<externalcode>tyDbsztojw62SFdCAlJ_a2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Schipper" updated="2014-02-27T19:23:07.620+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>0f595dc8-9fc3-11e3-ea5e-002590a28eca</uuid>
<code/>
<externalcode>66R1p9_mhIC8gBIHxNPw03</externalcode>
<description>
Картонная основа; Акриловые краски; Кисть; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Большие раскраски" updated="2013-07-03T16:07:01.775+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>11a1ae41-e3d9-11e2-b4a5-7054d21a8d1e</uuid>
<code>24</code>
<externalcode>46eJje9xivagRfR5H0J-u2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-Без" updated="2014-02-27T19:19:23.648+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>12df1e5c-9fc2-11e3-b718-002590a28eca</uuid>
<code/>
<externalcode>z27lkRAgi26BOxpSkqD-C2</externalcode>
<description>
Холст без подрамника; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Триптихи" updated="2013-12-11T13:03:25.158+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>17b916ea-6243-11e3-ede5-7054d21a8d1e</uuid>
<code>30</code>
<externalcode>AP_-BX1Ii42itZXc9YLuh3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="На холсте" updated="2013-07-03T16:07:22.566+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>1e0623a2-e3d9-11e2-770b-7054d21a8d1e</uuid>
<code>23</code>
<externalcode>8JL2d35HifGogiiW1kqLM0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Африканские слоны" updated="2013-07-03T16:07:40.879+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>28f070cd-e3d9-11e2-18c7-7054d21a8d1e</uuid>
<code>22</code>
<externalcode>uA2dji2iiBG2hN6a_zgYK2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="60x90" updated="2013-09-03T20:16:24.825+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>2dea4089-14b4-11e3-589a-7054d21a8d1e</uuid>
<code/>
<externalcode>vDBHNIithYifMPMPVqUrk2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Моне" updated="2013-07-03T16:07:50.994+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>2ef7f8d4-e3d9-11e2-3d17-7054d21a8d1e</uuid>
<code>21</code>
<externalcode>5ddiBOktgtOQhS1-XZQ3S0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="50x60" updated="2014-02-03T17:50:50.419+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>3101755f-8cda-11e3-467f-002590a28eca</uuid>
<code/>
<externalcode>UHzbFMrZjuKsZc3J5P3Te2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Ван Гог" updated="2013-07-03T16:08:01.572+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>35461150-e3d9-11e2-e044-7054d21a8d1e</uuid>
<code>20</code>
<externalcode>IcWe4J-zijS2O2FBbKBWy3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-Диптих" updated="2014-02-27T19:19:43.650+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>35b6777b-9fc2-11e3-21fc-002590a28eca</uuid>
<code/>
<externalcode>vRzfIEG4gdOY_OINABNqw2</externalcode>
<description>
2 холста на подрамнике; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Живопись" updated="2013-07-03T16:08:11.184+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>3b00a5cd-e3d9-11e2-55d1-7054d21a8d1e</uuid>
<code>5</code>
<externalcode>t1qQEWYgiw2hJFNKS5ACC3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Menglei" updated="2014-02-27T19:18:08.305+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>3e630d4c-9fc2-11e3-7e04-002590a28eca</uuid>
<code/>
<externalcode>Ve_sEjilicGvZS4d-GnJU2</externalcode>
<description>
Холст на подрамнике; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Для взрослых" updated="2013-07-03T16:08:24.488+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>42eeab9b-e3d9-11e2-0bee-7054d21a8d1e</uuid>
<code>19</code>
<externalcode>dAps-wjHiIKNOulwiTLfX1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="50x80" updated="2013-07-10T15:24:19.602+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>43592fd0-e953-11e2-bfc9-7054d21a8d1e</uuid>
<code/>
<externalcode>htMjx_3uguG2hJ82SMQUP2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Для детей" updated="2013-07-03T16:08:41.170+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>4ce038c0-e3d9-11e2-b145-7054d21a8d1e</uuid>
<code>18</code>
<externalcode>1SiOgGW_hu6JV63cq5T930</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Hobbart 40x50" updated="2014-02-25T17:57:43.552+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>4ff5c886-9e24-11e3-e43e-002590a28eca</uuid>
<code/>
<externalcode>p1ei5pMRjaiq2zwmR3_e32</externalcode>
<description>
холст на подрамнике;акриловые краски; 2 кисти;два контрольных листа;крепеж для подвешивания;
</description>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Диптих 60x120" updated="2013-11-29T19:38:38.920+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>5144e8e4-590c-11e3-3406-7054d21a8d1e</uuid>
<code/>
<externalcode>7CqzBGsSjTKc2mPfXHWXI3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="6235251e-e3d7-11e2-0de2-7054d21a8d1e" name="Dimensions" updated="2013-07-03T16:01:41.393+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>52ab4ea4-e3d8-11e2-77fb-7054d21a8d1e</uuid>
<code>337</code>
<externalcode>yQKyoxbKgIy4qKJAtHLvK0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="6235251e-e3d7-11e2-0de2-7054d21a8d1e" name="Menglei" updated="2013-07-03T16:01:57.504+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>5c45b02f-e3d8-11e2-af83-7054d21a8d1e</uuid>
<code>198</code>
<externalcode>2ullgEnlhLacrdqxG1Vk-2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Цветы" updated="2013-07-03T14:57:36.566+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>5ef94326-e3cf-11e2-c629-7054d21a8d1e</uuid>
<code>1</code>
<externalcode>lD6MOymKjgSwAyhWiArrO1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="80x120" updated="2013-07-10T13:23:28.769+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>6183f3ca-e942-11e2-2dbe-7054d21a8d1e</uuid>
<code/>
<externalcode>XXlddNMmjzWx1qQy_UCt22</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Люди" updated="2013-07-03T16:09:16.971+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>6236ffed-e3d9-11e2-14f1-7054d21a8d1e</uuid>
<code>3</code>
<externalcode>K9gHhYUDilSLWK1esNXs92</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="6235251e-e3d7-11e2-0de2-7054d21a8d1e" name="Живопись по номерам" updated="2013-07-03T16:02:12.291+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>651603e8-e3d8-11e2-14cf-7054d21a8d1e</uuid>
<code>197</code>
<externalcode>JxXRuB32h1qq16O7R2dxN0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Пейзажи" updated="2013-07-03T14:57:51.971+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>6827db02-e3cf-11e2-666f-7054d21a8d1e</uuid>
<code>2</code>
<externalcode>X6ojYMmbh-_TN1mQ_JsMb2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Животные" updated="2013-07-03T16:09:27.351+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>6866e528-e3d9-11e2-2b59-7054d21a8d1e</uuid>
<code>4</code>
<externalcode>oJvexJtRjuCtHm8RU00ob1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="40x120" updated="2013-07-10T15:25:36.844+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>716367c1-e953-11e2-48c6-7054d21a8d1e</uuid>
<code/>
<externalcode>AMOevBrPhRuWosZP-HMEk0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Здания и сооружения" updated="2013-07-03T16:09:42.855+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>71a4a34a-e3d9-11e2-d5b7-7054d21a8d1e</uuid>
<code>7</code>
<externalcode>OKDngigHhQWQNeITK6frD2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="1f0d12c7-9e20-11e3-2d2a-002590a28eca" name="На холсте" updated="2014-02-25T17:26:34.542+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>7252d719-9e20-11e3-4dee-002590a28eca</uuid>
<code/>
<externalcode>9lo8MikiiyuZ_U_damHL13</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="1f0d12c7-9e20-11e3-2d2a-002590a28eca" name="На картоне" updated="2014-02-25T17:26:43.537+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>77af5395-9e20-11e3-5495-002590a28eca</uuid>
<code/>
<externalcode>tfkM6EtDjDq6bPYWscS7i3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Абстракция" updated="2013-07-03T16:09:55.917+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>796db5a1-e3d9-11e2-595f-7054d21a8d1e</uuid>
<code>8</code>
<externalcode>lmWfIJKoivKGCOiCSRLqG1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Птицы" updated="2013-07-03T16:10:05.451+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>7f1c7335-e3d9-11e2-47cb-7054d21a8d1e</uuid>
<code>10</code>
<externalcode>mK_8Nuq9j3W_3MEtV6L483</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="6235251e-e3d7-11e2-0de2-7054d21a8d1e" name="Schipper" updated="2013-10-16T12:11:02.470+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>7f66e8bf-363a-11e3-30aa-7054d21a8d1e</uuid>
<code>506</code>
<externalcode>fcPzTBaujUCyMIrX7dfm23</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Фентези" updated="2013-07-03T16:10:15.783+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>854506e2-e3d9-11e2-9b0f-7054d21a8d1e</uuid>
<code>11</code>
<externalcode>LgFPzHJFgvGNdaBd6G7w_3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Без смешивания" updated="2013-08-28T17:34:20.830+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>861d509a-0fe6-11e3-c726-7054d21a8d1e</uuid>
<code>25</code>
<externalcode>fpTuARhBhhih1yfzdrLRj3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="10x15" updated="2013-07-03T16:03:11.570+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>886b3365-e3d8-11e2-073c-7054d21a8d1e</uuid>
<code/>
<externalcode>LKfCCvzEg8W7kDQ_p5Shm3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Мультфильмы" updated="2013-07-03T16:10:25.408+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>8b01961c-e3d9-11e2-46e7-7054d21a8d1e</uuid>
<code>12</code>
<externalcode>cW_ReIRhiYC5UEN9BFfI12</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="6235251e-e3d7-11e2-0de2-7054d21a8d1e" name="Hobbart" updated="2013-10-03T12:41:10.869+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>8debe702-2c07-11e3-c388-7054d21a8d1e</uuid>
<code>550</code>
<externalcode>UnXp5-fcjSuX1JO43DWos3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="15x20" updated="2013-07-03T16:03:23.371+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>8f73dbad-e3d8-11e2-e69b-7054d21a8d1e</uuid>
<code/>
<externalcode>KOobL10yiSunqt6InL2Wh2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="2dd9fda5-e3cf-11e2-9076-7054d21a8d1e" name="Японская живопись" updated="2013-07-03T16:10:37.601+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>924626c2-e3d9-11e2-6493-7054d21a8d1e</uuid>
<code>13</code>
<externalcode>cHviOOfAi86z_nwljmv772</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="20x30" updated="2013-07-03T16:03:33.662+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>959620fb-e3d8-11e2-ed8a-7054d21a8d1e</uuid>
<code/>
<externalcode>IsZYiPl0gMmVdtfeWycln0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Триптих 40x120" updated="2013-07-10T15:26:40.863+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>978bf2d3-e953-11e2-19ce-7054d21a8d1e</uuid>
<code/>
<externalcode>SsOXmxgCh4O8DxUzarIvD1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Триптих 60x120" updated="2013-07-10T13:20:42.310+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>9940faca-e93d-11e2-3136-7054d21a8d1e</uuid>
<code/>
<externalcode>rI_G1QiYjh2OYwnycUP3a0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="30x30" updated="2013-07-03T16:03:46.215+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>9d11a82f-e3d8-11e2-2fd3-7054d21a8d1e</uuid>
<code/>
<externalcode>Ag-u45SbiQWBWZsVO-2UX1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="30x40" updated="2013-07-03T16:03:58.782+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>a48f404c-e3d8-11e2-5d32-7054d21a8d1e</uuid>
<code/>
<externalcode>Um0uTMp4iq2vx0jdvwjfO2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-MA" updated="2014-02-27T19:19:04.961+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>a4fef9a0-9fc1-11e3-1660-002590a28eca</uuid>
<code/>
<externalcode>3LNcpYfTiI25ylxqFfsew2</externalcode>
<description>
Картонная основа; Акриловые краски; Кисть; Мини мольберт;
</description>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="40x40" updated="2013-07-03T16:04:08.755+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>aa810258-e3d8-11e2-51af-7054d21a8d1e</uuid>
<code/>
<externalcode>RBYZKH2ejKOlqZjrCMkwa2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="40x50" updated="2013-07-03T16:04:18.931+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>b091c1a0-e3d8-11e2-8d67-7054d21a8d1e</uuid>
<code/>
<externalcode>taBpOzHQi2_YJHOLeEHRb1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="80x160" updated="2014-02-03T15:17:10.727+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>b9a42aae-8cc4-11e3-7674-002590a28eca</uuid>
<code/>
<externalcode>J4QATxRFiEipC_5ivOrvZ0</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="40x60" updated="2013-07-03T16:04:40.776+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>bd96e822-e3d8-11e2-3fe1-7054d21a8d1e</uuid>
<code/>
<externalcode>orehPTmwhd2wSlnuj2fqP2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-Триптих" updated="2014-02-27T19:20:53.238+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>bf4054cd-9fc2-11e3-de6a-002590a28eca</uuid>
<code/>
<externalcode>XSwYvGOqigWtbnSks83D31</externalcode>
<description>
3 холста на подрамнике; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="50x50" updated="2013-07-03T16:04:52.315+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>c477a6a6-e3d8-11e2-f57f-7054d21a8d1e</uuid>
<code/>
<externalcode>uKOGAHAGiSeqFwLn4BVBU3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Полиптих 50X160" updated="2013-11-29T19:49:07.769+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>c817a2bf-590d-11e3-daac-7054d21a8d1e</uuid>
<code/>
<externalcode>8DmRLgewgY2-8ltcay3SS1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="60x60" updated="2013-07-03T16:05:03.709+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>cb423eaf-e3d8-11e2-8678-7054d21a8d1e</uuid>
<code/>
<externalcode>a0dl_eXpjdymY9JgSABKR1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-Полиптих" updated="2014-02-27T19:21:16.030+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>ccd5fddb-9fc2-11e3-87f1-002590a28eca</uuid>
<code/>
<externalcode>qOMP17Wwi5mu0g_x96Aaa0</externalcode>
<description>
4 холста на подрамнике; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="60x75" updated="2013-07-03T16:05:13.811+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>d147b4b2-e3d8-11e2-2ea2-7054d21a8d1e</uuid>
<code/>
<externalcode>OvSLLYtXj5mObr6vhz7ji2</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="60x80" updated="2013-07-03T16:05:23.256+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>d6e8e09d-e3d8-11e2-4add-7054d21a8d1e</uuid>
<code/>
<externalcode>BQ9cYs5fi8CCezn-F452c1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-Разборный" updated="2014-02-27T19:20:16.737+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>da6d5f02-9fc1-11e3-97bd-002590a28eca</uuid>
<code/>
<externalcode>D0u0CB7hjdOmgmJVmJ-rY2</externalcode>
<description>
Холст; Разборный подрамник; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины; Контрольный лист;
</description>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Триптих 50x120" updated="2013-11-29T19:42:33.620+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>dd294dd4-590c-11e3-551b-7054d21a8d1e</uuid>
<code/>
<externalcode>tT6vlhOaj_StILkdnK4GU1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="50x65" updated="2013-07-10T15:28:38.999+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>ddf6220a-e953-11e2-585f-7054d21a8d1e</uuid>
<code/>
<externalcode>nrX6ZeX2hj2zaLNy85dRf3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="60x120" updated="2013-07-03T16:05:38.577+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>e00ab59b-e3d8-11e2-9dae-7054d21a8d1e</uuid>
<code/>
<externalcode>JaMgYPqHiDCv_-xfi6Rsi3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Триптих 40x150" updated="2013-07-10T13:20:24.912+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>ec8efcc0-e3d8-11e2-1097-7054d21a8d1e</uuid>
<code/>
<externalcode>SEwJ6uA0gceflK3vfeSTa3</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="411726a9-9e20-11e3-ad4f-002590a28eca" name="Meng-Диптих-Разборный" updated="2014-02-27T19:22:12.259+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>ee59e8dd-9fc2-11e3-f8a2-002590a28eca</uuid>
<code/>
<externalcode>h6lTzAt1jK_yADkVNxr4y1</externalcode>
<description>
2 холста; 2 разборных подрамника; Акриловые краски; Набор кисточек; Крепеж для подвешивания картины;
</description>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Триптих 50x150" updated="2013-07-10T13:20:33.982+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>f71c4e13-e3d8-11e2-5114-7054d21a8d1e</uuid>
<code/>
<externalcode>2W0s0kGRhlWP9w8ewnkIE1</externalcode>
<description/>
</customEntity>
<customEntity entityMetadataUuid="e3d3723a-e3d7-11e2-cbba-7054d21a8d1e" name="Полиптих 18x24" updated="2013-10-16T12:43:13.720+04:00" updatedBy="admin@shalom" readMode="ALL" changeMode="ALL">
<accountUuid>686b3d0c-a14e-11e2-5e44-001b21d91495</accountUuid>
<accountId>686b3d0c-a14e-11e2-5e44-001b21d91495</accountId>
<uuid>fe845634-363e-11e3-2f76-7054d21a8d1e</uuid>
<code/>
<externalcode>0arTbWqviQSTnQidsynoR3</externalcode>
<description/>
</customEntity>
</collection>*/
?>