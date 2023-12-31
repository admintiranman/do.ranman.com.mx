<!DOCTYPE html> 
<html>
<head>
    <title>Organigrama</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="/bp/demo/js/jquery/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/bp/demo/js/jquery/jquery-ui-1.10.2.custom.min.js"></script>
    <link href="/bp/demo/js/jquery/ui-lightness/jquery-ui-1.10.2.custom.css" media="screen" rel="stylesheet" type="text/css" />

    <!-- jQuery UI Layout -->
    <script type="text/javascript" src="/bp/demo/jquerylayout/jquery.layout-latest.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/bp/demo/jquerylayout/layout-default-latest.css" />

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('body').layout(
			{
			    center__paneSelector: "#contentpanel"
			});
        });
    </script>
    <style>        
        #westpanel, #westpanel-resizer {
            display: none !important;
            visibility: hidden !important;
        }
    </style>

    <link href="/bp/demo/css/primitives.latest.css?2023" media="screen" rel="stylesheet" type="text/css" />
    <script  type="text/javascript" src="/bp/demo/js/primitives.min.js?2023"></script>
	
    <script type="text/javascript">
		var data = [];
        let aux = <?php echo json_encode($organigrama) ?>;
        for(i=0; i<aux.length; i++) {	
            let tc = aux[i].Talento_Clave == 1;
            let pc = aux[i].Puesto_Critico == 1;	
            console.log({i, pc, tc});
            data.push({
                id: aux[i].id, 
                parent: aux[i].reporta, 
                description: aux[i].nivel + (tc && pc ?   '\nT.C. / P.C.' : tc ? '\nT.C.' : pc ? '\nP.C.' : ''), 
                email: aux[i].correo, 
                groupTitleColor: aux[i].color, // "#4169e1", 
                image: "/bp/demo/images/photos/usr.png", 
                itemTitleColor: aux[i].color, 
                phone: aux[i].puesto, 
                title: aux[i].nombre, 
                label: aux[i].nombre,                 
            });
        }
    </script>

    <script type="text/javascript">
        var orgDiagram = null;
        var treeItems = {};

        jQuery(document).ready(function () {
            jQuery.ajaxSetup({
                cache: false
            });

            jQuery('#contentpanel').layout(
			{
			    center__paneSelector: "#centerpanel"
				, south__paneSelector: "#southpanel"
				, south__resizable: false
				, south__closable: false
				, south__spacing_open: 0
				, south__size: 50
				, west__size: 0
				, west__paneSelector: "#westpanel"
				, west__resizable: true
				, center__onresize: function () {
				    if (orgDiagram != null) {
				        jQuery("#centerpanel").orgDiagram("update", primitives.common.UpdateMode.Refresh);
				    }
				}
			});

            function ContainsKeyValue(obj, key, value) {
                if (obj[key] == value)
                    return { exist: true, json: obj };

                for (all in obj) {
                    if (obj[all] != null && obj[all][key] == value)
                        return { exist: true, json: obj[all] };

                    if (typeof obj[all] == "object" && obj[all] != null) {
                        var found = ContainsKeyValue(obj[all], key, value);
                        if (found.exist == true)
                            return { exist: true, json: found.json };
                    }
                }
                return { exist: false, json: null };
            }

            

            /* Page Fit Mode */
            var pageFitModes = jQuery("#pageFitMode");
            for (var key in primitives.common.PageFitMode) {
                var value = primitives.common.PageFitMode[key];
                pageFitModes.append(jQuery("<br/><label><input name='pageFitMode' type='radio' value='" + value + "' " + (value == primitives.common.PageFitMode.FitToPage ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=pageFitMode]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Orientation Type */
            var orientationTypes = jQuery("#orientationType");
            for (var key in primitives.common.OrientationType) {
                var value = primitives.common.OrientationType[key];
                orientationTypes.append(jQuery("<br/><label><input name='orientationType' type='radio' value='" + value + "' " + (value == primitives.common.OrientationType.Top ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=orientationType]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Vertical Alignmnet */
            var verticalAlignments = jQuery("#verticalAlignment");
            for (var key in primitives.common.VerticalAlignmentType) {
                var value = primitives.common.VerticalAlignmentType[key];
                verticalAlignments.append(jQuery("<br/><label><input name='verticalAlignment' type='radio' value='" + value + "' " + (value == primitives.common.VerticalAlignmentType.Middle ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=verticalAlignment]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Horizontal Alignmnet */
            var horizontalAlignments = jQuery("#horizontalAlignment");
            for (var key in primitives.common.HorizontalAlignmentType) {
                var value = primitives.common.HorizontalAlignmentType[key];
                horizontalAlignments.append(jQuery("<br/><label><input name='horizontalAlignment' type='radio' value='" + value + "' " + (value == primitives.common.HorizontalAlignmentType.Center ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=horizontalAlignment]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Minimal Visibility */
            var pageFitModes = jQuery("#minimalVisibility");
            for (var key in primitives.common.Visibility) {
                var value = primitives.common.Visibility[key];
                pageFitModes.append(jQuery("<br/><label><input name='minimalVisibility' type='radio' value='" + value + "' " + (value == primitives.common.Visibility.Dot ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=minimalVisibility]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Selection Path Mode */
            var selectionPathModes = jQuery("#selectionPathMode");
            for (var key in primitives.common.SelectionPathMode) {
                var value = primitives.common.SelectionPathMode[key];
                selectionPathModes.append(jQuery("<br/><label><input name='selectionPathMode' type='radio' value='" + value + "' " + (value == primitives.common.SelectionPathMode.FullStack ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=selectionPathMode]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Leaves Placement Type */
            var leavesPlacementType = jQuery("#leavesPlacementType");
            for (var key in primitives.common.ChildrenPlacementType) {
                var value = primitives.common.ChildrenPlacementType[key];
                leavesPlacementType.append(jQuery("<br/><label><input name='leavesPlacementType' type='radio' value='" + value + "' " + (value == primitives.common.ChildrenPlacementType.Horizontal ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=leavesPlacementType]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Has Selector Check Box*/
            var hasSelectorCheckbox = jQuery("#hasSelectorCheckbox");
            for (var key in primitives.common.Enabled) {
                var value = primitives.common.Enabled[key];
                hasSelectorCheckbox.append(jQuery("<br/><label><input name='hasSelectorCheckbox' type='radio' value='" + value + "' " + (value == primitives.common.Enabled.True ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=hasSelectorCheckbox]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Has User Buttons */
            var hasButtons = jQuery("#hasButtons");
            for (var key in primitives.common.Enabled) {
                var value = primitives.common.Enabled[key];
                hasButtons.append(jQuery("<br/><label><input name='hasButtons' type='radio' value='" + value + "' " + (value == primitives.common.Enabled.Auto ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=hasButtons]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Items Group By Type */
            var arrowsDirections = jQuery("#arrowsDirection");
            for (var key in primitives.common.GroupByType) {
                var value = primitives.common.GroupByType[key];
                arrowsDirections.append(jQuery("<br/><label><input name='arrowsDirection' type='radio' value='" + value + "' " + (value == primitives.common.GroupByType.None ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=arrowsDirection]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Connector Type */
            var connectorTypes = jQuery("#connectorType");
            for (var key in primitives.common.ConnectorType) {
                var value = primitives.common.ConnectorType[key];
                connectorTypes.append(jQuery("<br/><label><input name='connectorType' type='radio' value='" + value + "' " + (value == primitives.common.ConnectorType.Squared ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=connectorType]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Connectors Elbows Type */
            var elbowTypes = jQuery("#elbowType");
            for (var key in primitives.common.ElbowType) {
                var value = primitives.common.ElbowType[key];
                elbowTypes.append(jQuery("<br/><label><input name='elbowType' type='radio' value='" + value + "' " + (value == primitives.common.ElbowType.None ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=elbowType]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            // lineType
            var connectorShapeType = jQuery("#lineType");
            for (var key in primitives.common.LineType) {
                var value = primitives.common.LineType[key];
                connectorShapeType.append(jQuery("<br/><label><input name='lineType' type='radio' value='" + value + "' " + (value == primitives.common.LineType.Solid ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=lineType]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            // color
            var color = jQuery("<select></select>");
            jQuery("#color").append(color);
            for (var key in primitives.common.Colors) {
                var value = primitives.common.Colors[key];
                color.append(jQuery("<option value='" + value + "' " + (value == primitives.common.Colors.Silver ? "selected" : "") + " >" + key + "</option>"));
            };

            jQuery("#color").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            // minimizedItemCornerRadius
            var minimizedItemCornerRadiuses = ["NULL", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            var minimizedItemCornerRadius = jQuery("<select></select>");
            jQuery("#minimizedItemCornerRadius").append(minimizedItemCornerRadius);
            for (var index = 0; index < minimizedItemCornerRadiuses.length; index += 1) {
                var value = minimizedItemCornerRadiuses[index];
                minimizedItemCornerRadius.append(jQuery("<option value='" + (value == "NULL" ? -1 : value) + "' " + (value == "NULL" ? "selected" : "") + " >" + value + "</option>"));
            };

            jQuery("#minimizedItemCornerRadius").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Redraw);
            });

            // minimizedItemSize
            var minimizedItemSizes = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40];
            var minimizedItemSize = jQuery("<select></select>");
            jQuery("#minimizedItemSize").append(minimizedItemSize);
            for (var index = 0; index < minimizedItemSizes.length; index += 1) {
                var value = minimizedItemSizes[index];
                minimizedItemSize.append(jQuery("<option value='" + value + "' " + (value == 4 ? "selected" : "") + " >" + value + "</option>"));
            };

            jQuery("#minimizedItemSize").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Redraw);
            });

            // highlightPadding
            var highlightPaddings = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            var highlightPadding = jQuery("<select></select>");
            jQuery("#highlightPadding").append(highlightPadding);
            for (var index = 0; index < highlightPaddings.length; index += 1) {
                var value = highlightPaddings[index];
                highlightPadding.append(jQuery("<option value='" + value + "' " + (value == 2 ? "selected" : "") + " >" + value + "</option>"));
            };

            jQuery("#highlightPadding").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Redraw);
            });

            // Intervals
            var intervalNames = ["normalLevelShift", "dotLevelShift", "lineLevelShift", "normalItemsInterval", "dotItemsInterval", "lineItemsInterval", "cousinsIntervalMultiplier"];
            var intervals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 14, 16, 18, 20, 30, 40];
            var defaultConfig = new primitives.orgdiagram.Config();
            defaultConfig.dotItemsInterval = 2;
            for (var intervalIndex = 0; intervalIndex < intervalNames.length; intervalIndex++) {
                var intervalName = intervalNames[intervalIndex];
                var intervalSelector = jQuery("<select></select>");
                jQuery("#" + intervalName).append(intervalSelector);
                for (var index = 0; index < intervals.length; index += 1) {
                    var value = intervals[index];
                    var defaultValue = defaultConfig[intervalName];

                    intervalSelector.append(jQuery("<option value='" + value + "' " + (value == defaultValue ? "selected" : "") + " >" + value + "</option>"));
                };

                jQuery("#" + intervalName).change(function () {
                    Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
                });
            }

            // lineWidth
            var lineWidths = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            var lineWidth = jQuery("<select></select>");
            jQuery("#lineWidth").append(lineWidth);
            for (var index = 0; index < lineWidths.length; index += 1) {
                var value = lineWidths[index];
                lineWidth.append(jQuery("<option value='" + value + "' " + (value == 1 ? "selected" : "") + " >" + value + "</option>"));
            };

            jQuery("#lineWidth").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Show Labels */
            var showLabels = jQuery("#showLabels");
            for (var key in primitives.common.Enabled) {
                var value = primitives.common.Enabled[key];
                showLabels.append(jQuery("<br/><label><input name='showLabels' type='radio' value='" + value + "' " + (value == primitives.common.Enabled.Auto ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=showLabels]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Label Orientations */
            var labelOrientations = jQuery("#labelOrientation");
            for (var key in primitives.text.TextOrientationType) {
                var value = primitives.text.TextOrientationType[key];
                labelOrientations.append(jQuery("<br/><label><input name='labelOrientation' type='radio' value='" + value + "' " + (value == primitives.text.TextOrientationType.Horizontal ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=labelOrientation]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Label Placement */
            var labelPlacements = jQuery("#labelPlacement");
            for (var key in primitives.common.PlacementType) {
                var value = primitives.common.PlacementType[key];
                labelPlacements.append(jQuery("<br/><label><input name='labelPlacement' type='radio' value='" + value + "' " + (value == primitives.common.PlacementType.Top ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=labelPlacement]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Refresh);
            });

            /* Graphics Type */
            var graphicsType = jQuery("#graphicsType");
            for (var key in primitives.common.GraphicsType) {
                var value = primitives.common.GraphicsType[key];
                graphicsType.append(jQuery("<br/><label><input name='graphicsType' type='radio' value='" + value + "' " + (value == primitives.common.GraphicsType.SVG ? "checked" : "") + " />" + key + "</label>"));
            };

            jQuery("input:radio[name=graphicsType]").change(function () {
                Update(jQuery("#centerpanel"), primitives.common.UpdateMode.Recreate);
            });

            /* Setup & Run */
            Setup(jQuery("#centerpanel"));

            /* Load data */
            LoadData(jQuery("#centerpanel"));
        });

        function Setup(selector) {
            orgDiagram = selector.orgDiagram(GetOrgDiagramConfig());

            ShowGraphicsType(selector.orgDiagram("option", "actualGraphicsType"));
        }

        function LoadData(selector) {
            var index, len;
            for (index = 0, len = data.length; index < len; index += 1) {
                treeItems[data[index].id] = data[index];
            }

            /* set template for cursor item */
            data[0].templateName = "contactTemplate";

            selector.orgDiagram("option", {
                items: data,
                cursorItem: 0
            });
            selector.orgDiagram("update");
        }


        function Update(selector, updateMode) {
            selector.orgDiagram("option", GetOrgDiagramConfig());
            selector.orgDiagram("update", updateMode);

            ShowGraphicsType(selector.orgDiagram("option", "actualGraphicsType"));
        }

        function GetOrgDiagramConfig() {
            var graphicsType = parseInt(jQuery("input:radio[name=graphicsType]:checked").val(), 10);
            var pageFitMode = parseInt(jQuery("input:radio[name=pageFitMode]:checked").val(), 10);
            var orientationType = parseInt(jQuery("input:radio[name=orientationType]:checked").val(), 10);
            var minimalVisibility = parseInt(jQuery("input:radio[name=minimalVisibility]:checked").val(), 10);
            var selectionPathMode = parseInt(jQuery("input:radio[name=selectionPathMode]:checked").val(), 10);
            var leavesPlacementType = parseInt(jQuery("input:radio[name=leavesPlacementType]:checked").val(), 10);
            var hasSelectorCheckbox = parseInt(jQuery("input:radio[name=hasSelectorCheckbox]:checked").val(), 10);
            var hasButtons = parseInt(jQuery("input:radio[name=hasButtons]:checked").val(), 10);
            var verticalAlignment = parseInt(jQuery("input:radio[name=verticalAlignment]:checked").val(), 10);
            var horizontalAlignment = parseInt(jQuery("input:radio[name=horizontalAlignment]:checked").val(), 10);
            var connectorType = parseInt(jQuery("input:radio[name=connectorType]:checked").val(), 10);
            var elbowType = parseInt(jQuery("input:radio[name=elbowType]:checked").val(), 10);
            var showLabels = parseInt(jQuery("input:radio[name=showLabels]:checked").val(), 10);
            var labelOrientation = parseInt(jQuery("input:radio[name=labelOrientation]:checked").val(), 10);
            var labelPlacement = parseInt(jQuery("input:radio[name=labelPlacement]:checked").val(), 10);
            var color = jQuery("#color option:selected").val();
            var lineWidth = parseInt(jQuery("#lineWidth option:selected").val(), 10);
            var lineType = parseInt(jQuery("input:radio[name=lineType]:checked").val(), 10);
            var arrowsDirection = parseInt(jQuery("input:radio[name=arrowsDirection]:checked").val(), 10);


            var minimizedItemCornerRadius = parseInt(jQuery("#minimizedItemCornerRadius option:selected").val(), 10);
            minimizedItemCornerRadius = minimizedItemCornerRadius == -1 ? null : minimizedItemCornerRadius;

            var minimizedItemSize = parseInt(jQuery("#minimizedItemSize option:selected").val(), 10);
            var highlightPadding = parseInt(jQuery("#highlightPadding option:selected").val(), 10);

            var normalLevelShift = parseInt(jQuery("#normalLevelShift option:selected").val(), 10);
            var dotLevelShift = parseInt(jQuery("#dotLevelShift option:selected").val(), 10);
            var lineLevelShift = parseInt(jQuery("#lineLevelShift option:selected").val(), 10);
            var normalItemsInterval = parseInt(jQuery("#normalItemsInterval option:selected").val(), 10);
            var dotItemsInterval = parseInt(jQuery("#dotItemsInterval option:selected").val(), 10);
            var lineItemsInterval = parseInt(jQuery("#lineItemsInterval option:selected").val(), 10);
            var cousinsIntervalMultiplier = parseInt(jQuery("#cousinsIntervalMultiplier option:selected").val(), 10);

            var buttons = [];
            buttons.push(new primitives.orgdiagram.ButtonConfig("delete", "ui-icon-file", "Ver Información"));
            /*
            buttons.push(new primitives.orgdiagram.ButtonConfig("properties", "ui-icon-person", "Mapeo de Talento"));
            buttons.push(new primitives.orgdiagram.ButtonConfig("add", "ui-icon-file", "Plan de Desarrollo Individual"));
            */

            var templates = [
                getContactTemplate(minimizedItemCornerRadius, minimizedItemSize, highlightPadding),
                getDefaultTemplate(minimizedItemCornerRadius, minimizedItemSize, highlightPadding)
            ];

            return {
                graphicsType: graphicsType,
                pageFitMode: pageFitMode,
                orientationType: orientationType,
                verticalAlignment: verticalAlignment,
                horizontalAlignment: horizontalAlignment,
                arrowsDirection: arrowsDirection,
                connectorType: connectorType,
                elbowType: elbowType,
                minimalVisibility: minimalVisibility,
                hasSelectorCheckbox: hasSelectorCheckbox,
                selectionPathMode: selectionPathMode,
                leavesPlacementType: leavesPlacementType,
                hasButtons: hasButtons,
                buttons: buttons,
                templates: templates,
                onButtonClick: onButtonClick,
                onCursorChanging: onCursorChanging,
                onCursorChanged: onCursorChanged,
                onHighlightChanging: onHighlightChanging,
                onHighlightChanged: onHighlightChanged,
                onSelectionChanged: onSelectionChanged,
                onItemRender: onTemplateRender,
                itemTitleFirstFontColor: primitives.common.Colors.White,
                itemTitleSecondFontColor: primitives.common.Colors.White,
                showLabels: showLabels,
                labelOrientation: labelOrientation,
                labelPlacement: labelPlacement,
                labelOffset: 2,
                linesType: lineType,
                linesColor: color,
                linesWidth: lineWidth,
                defaultTemplateName: "defaultTemplate",
                normalLevelShift: normalLevelShift,
                dotLevelShift: dotLevelShift,
                lineLevelShift: lineLevelShift,
                normalItemsInterval: normalItemsInterval,
                dotItemsInterval: dotItemsInterval,
                lineItemsInterval: lineItemsInterval, 
                cousinsIntervalMultiplier: cousinsIntervalMultiplier
            };
        }

        function getDefaultTemplate(minimizedItemCornerRadius, minimizedItemSize, highlightPadding) {
            var result = new primitives.orgdiagram.TemplateConfig();
            result.name = "defaultTemplate";

            // If we don;t change anything in template all its properties assigned to default values
            // So we change only default dot size and corner radius
            result.minimizedItemSize = new primitives.common.Size(minimizedItemSize, minimizedItemSize);
            result.minimizedItemCornerRadius = minimizedItemCornerRadius;
            result.highlightPadding = new primitives.common.Thickness(highlightPadding, highlightPadding, highlightPadding, highlightPadding);

            return result;
        }

        function getContactTemplate(minimizedItemCornerRadius, minimizedItemSize, highlightPadding) {
            var result = new primitives.orgdiagram.TemplateConfig();
            result.name = "contactTemplate";

            result.itemSize = new primitives.common.Size(220, 120);
            result.minimizedItemSize = new primitives.common.Size(minimizedItemSize, minimizedItemSize);
            result.minimizedItemCornerRadius = minimizedItemCornerRadius;
            result.highlightPadding = new primitives.common.Thickness(highlightPadding, highlightPadding, highlightPadding, highlightPadding);


            var itemTemplate = jQuery(
			  '<div class="bp-item bp-corner-all bt-item-frame">'
				+ '<div name="titleBackground" class="bp-item bp-corner-all bp-title-frame" style="top: 2px; left: 2px; width: 216px; height: 20px;">'
					+ '<div name="title" class="bp-item bp-title" style="top: 3px; left: 6px; width: 208px; height: 18px;">'
					+ '</div>'
				+ '</div>'
				+ '<div class="bp-item bp-photo-frame" style="top: 26px; left: 2px; width: 50px; height: 60px;">'
					+ '<img name="photo" style="height: 60px; width:50px;" alt="foto" />'
				+ '</div>'
				+ '<div name="phone" class="bp-item" style="top: 26px; left: 56px; width: 162px; height: 28px; font-size: 12px;"></div>'
                + '<div class="bp-item" style="top: 54px; left: 56px; width: 162px; height: 18px; font-size: 12px;"><a name="email" href="" target="_top"></a></div>'
				+ '<div name="description" class="bp-item" style="top: 72px; left: 56px; width: 162px; height: 36px; font-size: 10px;"></div>'
			+ '</div>'
			).css({
			    width: result.itemSize.width + "px",
			    height: result.itemSize.height + "px"
			}).addClass("bp-item bp-corner-all bt-item-frame");
            result.itemTemplate = itemTemplate.wrap('<div>').parent().html();

            return result;
        }

        function onTemplateRender(event, data) {
            switch (data.renderingMode) {
                case primitives.common.RenderingMode.Create:
                    data.element.find("[name=email]").click(function (e) {
                        /* Block mouse click propogation in order to avoid layout updates before server postback*/
                        primitives.common.stopPropagation(e);
                    });
                    /* Initialize widgets here */
                    break;
                case primitives.common.RenderingMode.Update:
                    /* Update widgets here */
                    break;
            }

            var itemConfig = data.context,
                itemTitleColor = itemConfig.itemTitleColor != null ? itemConfig.itemTitleColor : primitives.common.Colors.RoyalBlue;

            if (data.templateName == "contactTemplate") {
                data.element.find("[name=photo]").attr({ "src": itemConfig.image });
                data.element.find("[name=titleBackground]").css({ "background": itemTitleColor });
                data.element.find("[name=email]").attr({ "href": ("mailto:" + itemConfig.email + "?Subject=Hello%20world") });

                var fields = ["title", "description", "phone", "email"];
                for (var index = 0; index < fields.length; index += 1) {
                    var field = fields[index];

                    var element = data.element.find("[name=" + field + "]");
                    if (element.text() != itemConfig[field]) {
                        element.text(itemConfig[field]);
                    }
                }
            }
        }

        function onSelectionChanged(e, data) {
            var selectedItems = jQuery("#centerpanel").orgDiagram("option", "selectedItems");
            var message = "";
            for (var index = 0; index < selectedItems.length; index += 1) {
                var itemConfig = treeItems[selectedItems[index]];
                if (message != "") {
                    message += ", ";
                }
                message += "<b>'" + itemConfig.title + "'</b>";
            }
            message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");
            jQuery("#southpanel").empty().append("User selected following items: " + message);
        }

        function onHighlightChanging(e, data) {
            var message = (data.context != null) ? "User is hovering mouse over item <b>'" + data.context.title + "'</b>." : "";
            message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");

            jQuery("#southpanel").empty().append(message);
        }

        function onHighlightChanged(e, data) {
            var message = (data.context != null) ? "User hovers mouse over item <b>'" + data.context.title + "'</b>." : "";
            message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");

            jQuery("#southpanel").empty().append(message);
        }

        function onCursorChanging(e, data) {
            var message = "User is clicking on item '" + data.context.title + "'.";
            message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");

            jQuery("#southpanel").empty().append(message);

            data.oldContext.templateName = null;
            data.context.templateName = "contactTemplate";
        }

        function onCursorChanged(e, data) {
            var message = "User clicked on item '" + data.context.title + "'.";
            message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");
            jQuery("#southpanel").empty().append(message);
        }

        function onButtonClick(e, data) {
            var message = "User clicked <b>'" + data.name + "'</b> button for item <b>'" + data.context.title + "'</b>.";
            message += (data.parentItem != null ? " Parent item <b>'" + data.parentItem.title + "'" : "");
            jQuery("#southpanel").empty().append(message);
        }

        function ShowGraphicsType(graphicsType) {
            var result = null;

            switch (graphicsType) {
                case primitives.common.GraphicsType.SVG:
                    result = "SVG";
                    break;
                case primitives.common.GraphicsType.Canvas:
                    result = "Canvas";
                    break;
                case primitives.common.GraphicsType.VML:
                    result = "VML";
                    break;
            }
            jQuery("#actualGraphicsType").empty().append("Graphics Type: " + result);
        }

    </script>
    <!-- /header -->
</head>
<body style="font-size: 12px">
    <div id="contentpanel" style="padding: 0px;">
        <!--bpcontent-->
        <div id="westpanel" style="padding: 5px; margin: 0px; border-style: solid; font-size: 12px; border-color: grey; border-width: 1px; overflow: scroll; -webkit-overflow-scrolling: touch;">
	
            <p id="pageFitMode">Page Fit Mode</p>
            <p id="orientationType">Orientation</p>
            <p id="verticalAlignment">Items Vertical Alignment</p>
            <p id="horizontalAlignment">Items Horizontal Alignment</p>
            <p id="leavesPlacementType">Leaves placement</p>
            <p id="minimalVisibility">Minimal nodes visibility</p>
            <p id="selectionPathMode">Selection Path Mode</p>
            <h3>Default Template Options</h3>
            <p id="hasButtons">User buttons</p>
            <p id="hasSelectorCheckbox">Selection check box</p>
            <h3>Minimized Item (Dot, Marker)</h3>
            <p id="minimizedItemCornerRadius">Corner Radius:&nbsp;</p>
            <p id="minimizedItemSize">Size:&nbsp;</p>
            <p id="highlightPadding">Highlight Padding:&nbsp;</p>            
            <h3>Vertical Intervals Between Rows</h3>
            <p id="normalLevelShift">Normal:&nbsp;</p>
            <p id="dotLevelShift">Dotted:&nbsp;</p>
            <p id="lineLevelShift">Lined:&nbsp;</p>
            <h3>Horizontal Intervals Between Items in Row</h3>
            <p id="normalItemsInterval">Normal:&nbsp;</p>
            <p id="dotItemsInterval">Dotted:&nbsp;</p>
            <p id="lineItemsInterval">Lined:&nbsp;</p>
            <p id="cousinsIntervalMultiplier">Cousins Multiplier:&nbsp;</p>
            <h3>Connectors</h3>
            <p id="arrowsDirection">Arrows Direction</p>
            <p id="connectorType">Connectors</p>
            <p id="elbowType">Connectors Elbows Type</p>
            <p id="lineType">Line type</p>
            <p id="color">Color:&nbsp;</p>
            <p id="lineWidth">Line width:&nbsp;</p>
            <h3>Labels</h3>
            <p id="showLabels">Show Labels</p>
            <p id="labelOrientation">Label Orientation</p>
            <p id="labelPlacement">Label Placement</p>
            <h3>Rendering Mode</h3>
            <p id="graphicsType">Graphics</p>
            <p id="actualGraphicsType"></p>
        </div>
        <div id="centerpanel" style="overflow: hidden; padding: 0px; margin: 0px; border: 0px;">
        </div>
        <!--/bpcontent-->
    </div>
</body>
</html>
